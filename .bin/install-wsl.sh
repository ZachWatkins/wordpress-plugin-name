#!/bin/bash
# If you have administrative rights on your computer, you can develop WordPress plugins using a Docker environment.
# This script will install NodeJS, PHP, and Composer for you and install project dependencies.

if [ "$(whoami)" != "root" ]; then
    SUDO=sudo
fi

NVM_VERSION="0.39.0"
PHP_VERSION="8.1.2"
NODE_VERSION="18.18.0"

if ! command -v curl &> /dev/null
then
    ${SUDO} apt-get update
    ${SUDO} apt-get -y install curl
fi

if ! command -v nvm &> /dev/null
then
    echo "NVM could not be found. Installing..."
    curl -o- "https://raw.githubusercontent.com/nvm-sh/nvm/v${NVM_VERSION}/install.sh" | bash
    export NVM_DIR="$HOME/.nvm"
    [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
    ${SUDO} chmod +x $HOME/.nvm/nvm.sh
    echo "NVM ${NVM_VERSION} installed."
fi

if ! command -v node &> /dev/null
then
    ${SUDO} ${NVM_DIR}/nvm.sh install $NODE_VERSION
    ${SUDO} ${NVM_DIR}/nvm.sh alias default $NODE_VERSION
    echo "NodeJS v${NODE_VERSION} installed."
else
    NODE_VERSION_INSTALLED=`node -v | cut -d "v" -f 2`
    if [ "$NODE_VERSION_INSTALLED" != "$NODE_VERSION" ]; then
        ${SUDO} ${NVM_DIR}/nvm.sh install $NODE_VERSION
        ${SUDO} ${NVM_DIR}/nvm.sh alias default $NODE_VERSION
        echo "NodeJS v${NODE_VERSION} installed."
    fi
fi

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
    echo "PHP v${PHP_VERSION} installed."
fi

INSTALL_COMPOSER=false
if ! command -v composer &> /dev/null
then
    INSTALL_COMPOSER=true
fi

if [ "$INSTALL_COMPOSER" = true ]; then
    ${SUDO} apt-get update
    ${SUDO} apt install composer --no-install-recommends
    echo "Composer installed"
fi

if [ ! -d "node_modules" ]; then
    npm install
    echo "+ node_modules/"
fi

if [ ! -d "vendor" ]; then
    composer install
    echo "+ vendor/"
fi

echo "Installation finished. You must restart your terminal session before using newly installed command line applications."
