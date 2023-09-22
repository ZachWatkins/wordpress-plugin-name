#!/bin/bash
# Install developer tools for Linux or Windows Subsystem for Linux (WSL).
if [ "$(whoami)" != "root" ]; then
    SUDO=sudo
fi
NVM_VERSION=0.39.0
NODE_VERSION=18.18.0
PHP_VERSION=8.1

# Download Node Version Manager.
if ! command -v nvm &> /dev/null
then
    echo "NVM could not be found. Installing NVM..."
    curl -o- "https://raw.githubusercontent.com/nvm-sh/nvm/v${NVM_VERSION}/install.sh" | bash
    echo "NVM v${NVM_VERSION} installed."
fi
${SUDO} chmod +x $HOME/.nvm/nvm.sh
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"  # This loads nvm bash_completion

# Download latest Node LTS.
if ! ${SUDO} ${NVM_DIR}/nvm.sh ls | grep "$NODE_VERSION"
then
    echo "Installing Node LTS v$NODE_VERSION..."
    ${SUDO} ${NVM_DIR}/nvm.sh install $NODE_VERSION
    echo "Node LTS v$NODE_VERSION installed."
fi

${NVM_DIR}/nvm.sh alias default $NODE_VERSION
echo "The default Node version is now v$NODE_VERSION."

# Install PHP.
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
    echo "PHP version $PHP_VERSION could not be found. Installing..."
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

echo "Installation finished. You must restart your terminal session before changes will take effect."
