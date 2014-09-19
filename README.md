# CiviCRM Statistics gathering

This package's purpose is to:
  1. gather project statistics from various sources
  2. summarize these statistics in json files
  3. use these json files in project dashboards

Goals 1 and 2 are realized by this code. Goal 3 is realized by leveraging the published json files from 2
 in external dashboard services such as Klipfolio or any other service capable of ingesting json.

# 1. Gather project statistics
This is done by the 'getdata.php' scripts in each subdirectory. Thea reason these scripts are independant is that we
might need different refresh schedules for each data source.

# 2. Summarize the stats in json files
This is done by the 'generate.php' script in the project root. This file will consume the 'generate.inc.php' files in
 each subdirectory to gather the json file name and query needed to be run to generate it.

# Other considerations
You should run composer to download the project dependencies.
The project file 'config.php' is not published as it contains sensitive data.
Each subdirectory might also contain:
 - a 'db_create.sql' for creating the tables it needs in the database
 - a 'refs' folder with links and/or documentation that helped in the development