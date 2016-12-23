#! /bin/bash
DEST=/var/www/stats.civicrm.org/public/

# For the log file
echo "--- CiviCRM Statistics run on `date` ---"

# Change to the directory this script is in
cd "$(dirname $(readlink -f $0))"

# Refresh data for each of the defined sources
for DIR in *; do
    if [ -d $DIR ] && [ -f $DIR/getdata.php ]; then
      pushd $DIR > /dev/null
      php getdata.php
      popd > /dev/null
    fi
done

# Regenerate statistics and push to destination
php generate.php
php historical.php
rsync -a json $DEST
# create .htaccess to allow access from anywhere (cf. CORS for $.getJSON)
echo 'Header add Access-Control-Allow-Origin "*"' > $DEST/.htaccess

# and also archive (will someday be useful one way or another ...)
cp -R json /var/www/stats.civicrm.org/archive/`date +%F`

# For the log file
echo --- Done ---
echo