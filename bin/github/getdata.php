<?php
require_once(dirname(__DIR__) . '/config.php');
require_once(__DIR__ . '/github-php-client-master/client/GitHubClient.php');

$repos = array(
  'civicrm/civicrm-core',
  'civicrm/civicrm-packages',
  'civicrm/civicrm-drupal',
  'civicrm/civicrm-wordpress',
  'civicrm/civicrm-joomla',
);

// Initialize database and prepared statements
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);
$stm_c = $dbh->prepare("
  INSERT INTO github_commit (repository, hash, author_login, author_date, committer_login, committer_date, message)
  VALUES (:repository, :hash, :author_login, :author_date, :committer_login, :committer_date, :message);
");
$stm_u = $dbh->prepare("
  INSERT INTO github_user (id, login, name, company, email, location, avatar_url)
  VALUES (:id, :login, :name, :company, :email, :location, :avatar_url)
  ON DUPLICATE KEY UPDATE
     id=:id, login=:login, name=:name, company=:company, email=:email, location=:location, avatar_url=:avatar_url;
");

// Initialize GitHub
$client = new GitHubClient();
$client->setCredentials(GITHUB_USERNAME, GITHUB_PASSWORD);

// Loop over each repository
$users = array();
foreach($repos as $repo) {
  echo "Repository $repo ...";
  $new_commits = 0;

  // Get last commit date in database
  $result = $dbh->query("SELECT MAX(author_date) FROM github_commit WHERE repository='$repo';")->fetch();

  // Get commits from GitHub
  $parts = explode('/', $repo);
  $client->setPage(); // reinitialize the results pager
  $commits = $client->repos->commits->listCommitsOnRepository($parts[0], $parts[1], null, null, null, $result[0]);

  // Loop over each commit (paged)
  while (sizeof($commits)) {
    foreach($commits as $commit) {
      $params = array(
        ':repository' => $repo,
        ':hash' => $commit->getSha(),
        ':author_login' => ($commit->getAuthor() ? $commit->getAuthor()->getLogin() : ''),
        ':author_date' => date('Y-m-d H:i:s', strtotime($commit->getCommit()->getAuthor()->getDate())),
        ':committer_login' => ($commit->getCommitter() ? $commit->getCommitter()->getLogin() : ''),
        ':committer_date' => date('Y-m-d H:i:s', strtotime($commit->getCommit()->getCommitter()->getDate())),
        ':message' => substr($commit->getCommit()->getMessage(), 0, 1000),
      );
      if ($stm_c->execute($params)) {
        $new_commits++;
      } else {
        $errorInfo = $stm_c->errorInfo();
        echo $errorInfo[2] . PHP_EOL;
      }
    }
    $commits = $client->getNextPage();
  }
  echo " $new_commits new commit(s)" . PHP_EOL;
}

// Now update all user records
echo "Updating users ...";
$updated = $skipped = 0;
$query = "SELECT DISTINCT author_login FROM github_commit WHERE author_login > ''";
foreach ($dbh->query($query) as $row) {
  $client->setPage(); // reinitialize the results pager
  try {
    $user = $client->users->getSingleUser($row[0]);
  } catch (Exception $e) {
    $skipped ++;
    continue;
  }
  /* @var $user GitHubFullUser */
  if ($user) {
    $params = array(
      ':id' => $user->getId(),
      ':login' => $user->getLogin(),
      ':name' => $user->getName(),
      ':company' => $user->getCompany(),
      ':email' => $user->getEmail(),
      ':location' => $user->getLocation(),
      ':avatar_url' => $user->getAvatarUrl(),
    );
    if ($stm_u->execute($params)) {
      $updated ++;;
    } else {
      $errorInfo = $stm_u->errorInfo();
      echo $errorInfo[2] . PHP_EOL;
    }
  } else {
    echo "Unknown user - login: " . $row[0] . "\n";
  }
}
$query = "
  UPDATE github_user
     SET first_commit = (
           SELECT MIN(author_date)
             FROM github_commit
            WHERE author_login = login
           )
    WHERE first_commit IS NULL;
    ";
$dbh->query($query);
echo " $updated updates, $skipped in error." . PHP_EOL;