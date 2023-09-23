#!/bin/bash
# Set up the local WordPress development environment when a user cannot use admin privileges.
# Set up the WordPress installation to use SQLite, have a default theme, and use the plugin we're developing via a symbolic link.

if [ ! -d "wordpress" ]; then
    echo "WordPress not found. Run `composer install` first."
    exit 1
fi

if [ ! -d "wordpress/wp-content" ]; then
    mkdir wordpress/wp-content
fi

if [ ! -d "wordpress/wp-content/mu-plugins" ]; then
    mkdir wordpress/wp-content/mu-plugins
fi

if [ ! -d "wordpress/wp-content/plugins" ]; then
    mkdir wordpress/wp-content/plugins
fi

if [ ! -f "wordpress/wp-config.php" ]; then
    cp wordpress/wp-config-sample.php wordpress/wp-config.php
fi

# Set up the SQLite database plugin.
if [ ! -f "wordpress/wp-content/db.php" ]; then
    CONTENTS=$(cat vendor/wordpress/sqlite-database-integration/db.copy)
    CONTENTS=${CONTENTS//"{SQLITE_IMPLEMENTATION_FOLDER_PATH}"/"$(pwd)/vendor/wordpress/sqlite-database-integration"}
    CONTENTS=${CONTENTS//"{SQLITE_PLUGIN}"/"sqlite-database-integration/load.php"}
    echo "$CONTENTS" > wordpress/wp-content/db.php
fi

if [ ! -d "wordpress/wp-content/mu-plugins/sqlite-database-integration" ]; then
    ln -s "$(pwd)/vendor/wordpress/sqlite-database-integration" wordpress/wp-content/mu-plugins/sqlite-database-integration
fi

# Create a symbolic link for the working directory.
if [ ! -d wordpress/wp-content/plugins/wordpress-plugin-name ]; then
    ln -s "$(pwd)" wordpress/wp-content/plugins/wordpress-plugin-name
fi
