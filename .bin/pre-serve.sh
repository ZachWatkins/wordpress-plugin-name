#!/bin/bash
# Prepare the local WordPress directory for serving with PHP's default web server.

# Remove the generated files.
test -f wordpress/wp-config.php && rm wordpress/wp-config.php
test -d wordpress/wp-content || mkdir wordpress/wp-content
test -d wordpress/databse && rm -rf wordpress/database
mkdir wordpress/wp-content/database
touch wordpress/wp-content/database/.ht.sqlite
mkdir wordpress/wp-content/plugins
mkdir wordpress/wp-content/themes
mkdir wordpress/wp-content/mu-plugins

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

# Integrate the SQLite plugin.
if [ ! -s wordpress/wp-content/plugins/sqlite-database-integration ]; then
    ln -s $(pwd)/vendor/wordpress/sqlite-database-integration wordpress/wp-content/plugins/sqlite-database-integration
fi
cp vendor/wordpress/sqlite-database-integration/db.copy wordpress/wp-content/db.php
sed -i "s+{SQLITE_IMPLEMENTATION_FOLDER_PATH}+$(pwd)/wordpress/plugins/sqlite-database-integration+g" wordpress/wp-content/db.php
sed -i "s+{SQLITE_PLUGIN}+sqlite-database-integration/load.php+g" wordpress/wp-content/db.php
chmod -R 644 wordpress/wp-content/database
chmod 766 wordpress/wp-content/database
echo 'DENY FROM ALL' > wordpress/wp-content/database/.htaccess
# sqlite3 wordpress/wp-content/database/.ht.sqlite < .wp-env/schema.sql
sqlite3 wordpress/wp-content/database/.ht.sqlite < .wp-env/seeds.sql
# Make additional changes to wordpress/wp-content/db.php so it installs WordPress automatically for the new .sqlite database file.
# INIT_DB="require_once ABSPATH . WPINC . '/cache.php';"
# INIT_DB="$INIT_DB"$'\n'"wp_cache_init();"
# INIT_DB="$INIT_DB"$'\n'"if ( ! is_blog_installed() && ! wp_installing() ) {"
# INIT_DB="$INIT_DB"$'\n'"    require_once ABSPATH . 'wp-content/plugins/sqlite-database-integration/tests/wp-sqlite-schema.php';"
# INIT_DB="$INIT_DB"$'\n'"    \$wpdb->query(\$blog_tables);"
# INIT_DB="$INIT_DB"$'\n'"    require_once ABSPATH . WPINC . '/l10n.php';"
# INIT_DB="$INIT_DB"$'\n'"    require_once ABSPATH . 'wp-admin/includes/upgrade.php';"
# INIT_DB="$INIT_DB"$'\n'"    wp_install('Truck Parts and Service', 'admin', 'user@site.local', true, '', 'password');"
# INIT_DB="$INIT_DB"$'\n'"}"
# echo "$INIT_DB" >> wordpress/wp-content/db.php

# Link the root directory to the plugins directory.
if [ ! -s wordpress/wp-content/plugins/wordpress-plugin-name ]; then
    ln -s $(pwd) wordpress/wp-content/plugins/wordpress-plugin-name
fi

test -d wordpress/wp-content/mu-plugins || mkdir wordpress/wp-content/mu-plugins
if [ ! -s wordpress/wp-content/mu-plugins/demo-site.php ]; then
    ln -s $(pwd)/.wp-env/demo-site.php wordpress/wp-content/mu-plugins/demo-site.php
fi

