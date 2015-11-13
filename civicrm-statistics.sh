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
rsync -a json/ $DEST

# For the log file
echo --- Done ---
echo