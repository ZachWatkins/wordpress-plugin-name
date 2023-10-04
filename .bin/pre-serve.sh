#!/bin/bash
# Prepare the local WordPress directory for serving with PHP's default web server.

# Remove generated files.
test -f wordpress/wp-config.php && rm wordpress/wp-config.php
test -d wordpress/wp-content/database && rm -r wordpress/wp-content/database
test -f wordpress/wp-content/db.php && rm wordpress/wp-content/db.php

# Create directories if missing.
mkdir -p wordpress/wp-content/plugins
mkdir -p wordpress/wp-content/mu-plugins
mkdir -p wordpress/wp-content/themes

# Link the root directory to the plugin folder.
if [ ! -s wordpress/wp-content/plugins/wordpress-plugin-name ]; then
    ln -s $(pwd) wordpress/wp-content/plugins/wordpress-plugin-name
fi

# Download the WordPress core theme.
if [ ! -f .bin/.tmp/twentytwentythree.zip ]; then
    curl https://downloads.wordpress.org/theme/twentytwentythree.1.2.zip --output .bin/.tmp/twentytwentythree.zip
fi
if [ ! -d wordpress/wp-content/themes/twentytwentythree ]; then
    unzip .bin/.tmp/twentytwentythree.zip -d wordpress/wp-content/themes
fi

# Create the wp-config file.
CONFIG_CONTENT=$(cat wordpress/wp-config-sample.php)
FIND="define( 'WP_DEBUG', false );"
REPLACE="define( 'WP_DEBUG', true );"$'\n'"define( 'WP_DEBUG_DISPLAY', true );"$'\n'"@ini_set( 'display_errors', 0 );"$'\n'"define( 'WP_DEBUG_LOG', true );"$'\n'"define( 'WP_ENVIRONMENT_TYPE', 'local' );"$'\n'"define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );"$'\n'"define( 'WPLANG', 'en_CA' );"$'\n'
CONFIG_CONTENT=${CONFIG_CONTENT//$FIND/$REPLACE}
echo "$CONFIG_CONTENT" > wordpress/wp-config.php

# Link the SQLite plugin.
if [ ! -s wordpress/wp-content/plugins/sqlite-database-integration ]; then
    ln -s $(pwd)/vendor/wordpress/sqlite-database-integration wordpress/wp-content/plugins/sqlite-database-integration
fi

# Copy the SQLite integration file.
cp vendor/wordpress/sqlite-database-integration/db.copy wordpress/wp-content/db.php
sed -i "s+{SQLITE_IMPLEMENTATION_FOLDER_PATH}+$(pwd)/wordpress/plugins/sqlite-database-integration+g" wordpress/wp-content/db.php
sed -i "s+{SQLITE_PLUGIN}+sqlite-database-integration/load.php+g" wordpress/wp-content/db.php

# Create the SQLite database directory.
mkdir -p wordpress/wp-content/database
echo 'DENY FROM ALL' > wordpress/wp-content/database/.htaccess
touch wordpress/wp-content/database/.ht.sqlite
chmod -R 644 wordpress/wp-content/database
chmod 766 wordpress/wp-content/database
sqlite3 wordpress/wp-content/database/.ht.sqlite < .wp-env/seeds.sql
