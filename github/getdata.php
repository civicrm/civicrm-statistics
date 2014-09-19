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
$client->setCredentials('nganivet', '6CS9kJ4drP');

// Loop over each repository
$users = array();
foreach($repos as $repo) {
  echo "Repository $repo ...";
  $new_commits = 0;
  $stm_c->bindParam(':repository', $repo);

  // Get last commit date in database
  $result = $dbh->query("SELECT MAX(author_date) FROM github_commit WHERE repository='$repo';")->fetch();

  // Get commits from GitHub
  $parts = explode('/', $repo);
  $client->setPage(); // reinitialize the results pager
  $commits = $client->repos->commits->listCommitsOnRepository($parts[0], $parts[1], null, null, null, $result[0]);

  // Loop over each commit (paged)
  while (sizeof($commits)) {
    foreach($commits as $commit) {
      /* @var $commit GitHubCommit */

      // Write commit to database
      $stm_c->bindParam(':hash', $commit->getSha());
      $author_login = ($commit->getAuthor() ? $commit->getAuthor()->getLogin() : '');
      $stm_c->bindParam(':author_login', $author_login);
      $stm_c->bindParam(':author_date', $commit->getCommit()->getAuthor()->getDate());
      $committer_login = ($commit->getCommitter() ? $commit->getCommitter()->getLogin() : '');
      $stm_c->bindParam(':committer_login', $committer_login);
      $stm_c->bindParam(':committer_date', $commit->getCommit()->getCommitter()->getDate());
      $stm_c->bindParam(':message', $commit->getCommit()->getMessage());
      $stm_c->execute();
      $new_commits++;
    }
    $commits = $client->getNextPage();
  }
  echo " $new_commits new commit(s)" . PHP_EOL;
}

// Now update all user records
echo "Updating users ...";
echo $updated = 0;
$query = "SELECT DISTINCT author_login FROM github_commit WHERE author_login > ''";
foreach ($dbh->query($query) as $row) {
  $client->setPage(); // reinitialize the results pager
  $user = $client->users->getSingleUser($row[0]);
  /* @var $user GitHubFullUser */
  if ($user) {
    $stm_u->bindParam(':id', $user->getId());
    $stm_u->bindParam(':login', $user->getLogin());
    $stm_u->bindParam(':name', $user->getName());
    $stm_u->bindParam(':company', $user->getCompany());
    $stm_u->bindParam(':email', $user->getEmail());
    $stm_u->bindParam(':location', $user->getLocation());
    $stm_u->bindParam(':avatar_url', $user->getAvatarUrl());
    $stm_u->execute();
    $updated ++;
  } else {
    echo "Unknown user - login: " . $row[0] . "\n";
  }
}
echo " $updated updates" . PHP_EOL;