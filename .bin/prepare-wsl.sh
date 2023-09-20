#!/bin/bash
# Install command line tools for Windows Subsystem for Linux (WSL).

# Install curl if not found.
if ! command -v curl &> /dev/null
then
    echo "Installing curl..."
    sudo apt-get install curl
fi

# Install Node Version Manager (nvm) if not found.
if ! command -v nvm &> /dev/null
then
    echo "Installing nvm..."
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/master/install.sh | bash
fi
