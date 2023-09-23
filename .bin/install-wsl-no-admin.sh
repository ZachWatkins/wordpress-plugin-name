#!/bin/bash
# If you do not have administrative rights on your computer, you can still develop WordPress plugins.
# This script will set up a local WordPress development environment for you.
# You will not be able to use Docker, but you will be able to use the default PHP server to serve the /wordpress/ directory.

if [ "$(whoami)" != "root" ]; then
    SUDO=sudo
fi

PHP_VERSION="8.1.2"
NODE_VERSION="18.18.0"

# Install NodeJS.
if ! command -v node &> /dev/null
then
    echo "NodeJS v${NODE_VERSION} could not be found. Installing..."
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
    export NVM_DIR="$HOME/.nvm"
    [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
    ${SUDO} chmod +x $HOME/.nvm/nvm.sh
    ${SUDO} ${NVM_DIR}/nvm.sh install $NODE_VERSION
    ${SUDO} ${NVM_DIR}/nvm.sh alias default $NODE_VERSION
    echo "NodeJS v${NODE_VERSION} installed."
fi

# Install PHP and Composer.
INSTALL_PHP=false
if ! command -v php &> /dev/null
then
    INSTALL_PHP=true
else
    PHP_VERSION_INSTALLED=`php -v | sed -n 1p | cut -d " " -f 2 | cut -d "-" -f 1`
    if [ "$PHP_VERSION_INSTALLED" != "$PHP_VERSION" ]; then
        INSTALL_PHP=true
    fi
fi

if [ "$INSTALL_PHP" = true ]; then
    echo "PHP v${PHP_VERSION} could not be found. Installing..."
    ${SUDO} apt-get update
    ${SUDO} apt-get -y install lsb-release ca-certificates curl
    ${SUDO} curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg
    ${SUDO} sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
    ${SUDO} apt-get update
    ${SUDO} apt install "php${PHP_VERSION}" -y --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-common" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-gd" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-ctype" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-curl" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-dom" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-fileinfo" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-mbstring" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-opcache" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-pdo" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-tokenizer" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-xml" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-zip" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-sqlite3" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-mysql" --no-install-recommends
    ${SUDO} apt install "php${PHP_VERSION}-bcmath" --no-install-recommends
    ${SUDO} apt install composer --no-install-recommends
    echo "PHP installed."
fi

if [ ! -d "node_modules" ]; then
    npm install
fi

if [ ! -d "vendor" ]; then
    composer install
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

if [ ! -d "wordpress/wp-content/plugins/wordpress-plugin-name" ]; then
    ln -s "$(pwd)" wordpress/wp-content/plugins/wordpress-plugin-name
fi

if [ ! -d "wordpress/wp-content/themes/twentytwentythree" ]; then
    curl -L https://downloads.wordpress.org/theme/twentytwentythree.1.2.zip -o .bin/.tmp/twentytwentythree.zip
    unzip .bin/.tmp/twentytwentythree.zip -d wordpress/wp-content/themes
fi

if [ ! -f "wordpress/wp-content/db.php" ]; then
    CONTENTS=$(cat vendor/wordpress/sqlite-database-integration/db.copy)
    CONTENTS=${CONTENTS//"{SQLITE_IMPLEMENTATION_FOLDER_PATH}"/"$(pwd)/vendor/wordpress/sqlite-database-integration"}
    CONTENTS=${CONTENTS//"{SQLITE_PLUGIN}"/"sqlite-database-integration/load.php"}
    echo "$CONTENTS" > wordpress/wp-content/db.php
fi

if [ ! -d "wordpress/wp-content/mu-plugins/sqlite-database-integration" ]; then
    ln -s "$(pwd)/vendor/wordpress/sqlite-database-integration" wordpress/wp-content/mu-plugins/sqlite-database-integration
fi

echo "Installation finished. You must restart your terminal session before changes will take effect."
