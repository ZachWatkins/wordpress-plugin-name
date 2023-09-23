# WordPress Plugin Template

This plugin is a template for creating a WordPress plugin. It is a fully working plugin itself, but it has very limited functionality. It only includes a starting point for features that you may want to implement in your own plugin. Remove features that you will not need and then extend the features you keep or add your own.

The goal is to provide a reliable, portable codebase with well-defined dependencies and minimal time for someone to make their first contribution even if they have never seen this code before.

**Table of Contents**

-   [Getting Started](#getting-started)
-   [Directory Structure](#directory-structure)
-   [Commands](#commands)
-   [wp-env](#wp-env)
-   [Tests](#tests)
-   [Installing System Requirements for Development](#system-requirements-for-development)
-   [Further Reading](#further-reading)

## Getting Started

**First**, either clone this repository to your computer or use this template repository to create a new repository on your GitHub account.

`git clone https://github.com/zachwatkins/wordpress-plugin-name.git your-plugin-slug`

**Then**, replace all instances of the default plugin name with your plugin name. All WordPress plugins are loaded in a global scope, so we avoid global scope conflicts by using a namespace for our plugin's global constants, classes, functions, and database content.

Use the following search and replace terms to find and replace all instances of the default plugin name:

1. `wordpress-plugin-name` - The plugin slug. This is the name of your plugin folder and root plugin file. Rename the root plugin file and replace the text in every file that uses it. Use this format: `<your-plugin-slug>`.
2. `wordpress_plugin_name` - The global prefix for your plugin. Defined in `.config/.phpcs.xml.dist`. Use this format: `your_plugin_slug`.
3. `WordPress_Plugin_Name` - This is the namespace of your plugin's PHP files. Use this format: `Your_Plugin_Name`.
4. `WORDPRESS_PLUGIN_NAME_[...]` - This is the prefix for your plugin's global constants in PHP. Use this format: `YOUR_PLUGIN_SLUG_[...]`.
5. `@package WordPress Plugin Name` - Used in PHP comments as a WordPress documentation requirement. Use this format: `@package Your Plugin Name`.
6. `wordpress-plugin-textdomain` - The plugin textdomain. Defined in `.config/.phpcs.xml.dist`. This is used for translations when your plugin supports them. Use this format: `<your-plugin-slug>`.

**Finally**, set up your local development environment using these command line commands from the root of your plugin:

```
npm install
npm start
npm run composer install
```

### Required Reading

The links below describe key WordPress code concepts you will need to know in order to develop your WordPress plugin.

-   [Action Hooks](https://developer.wordpress.org/plugins/hooks/actions/)
-   [Filter Hooks](https://developer.wordpress.org/plugins/hooks/filters/)

## Directory Structure

1. **.bin** - Custom scripts for local development.
2. **.github** - GitHub integration files such as Actions workflows.
3. **.vscode** - Visual Studio Code integration files.
4. **.wp-env** - WordPress development environment default content.
5. **assets** - JavaScript, CSS, images, fonts, and other static files.
6. **common** - Common WordPress feature implementations that you can copy and modify for your plugin.
7. **docs** - Documentation files going in depth on different aspects of this project or WordPress development.
8. **includes** - File content output to the browser by the plugin. This is where you should put most or all of the HTML output from your plugin, to make that content easier to find and change.
9. **src** - PHP classes that hook into WordPress and implement plugin features.
10. **test** - Plugin code tests.  
    a. **e2e** - Browser tests using Playwright.  
    b. **jest** - JavaScript tests using Jest.  
    c. **phpunit** - WordPress PHP code tests using PHPUnit.

## Commands

The commands you will use the most frequently for developing a plugin with this repository are listed below.

For a complete list of commands, refer to [package.json](package.json) and [composer.json](composer.json). For descriptions of what these commands do, see here: [docs/commands.md](docs/commands.md)

|-------------------------------------------------------------------------------------|
| Command | Description |
| -------------------------- | -------------------------------------------------------|
| `npm install` | Install your project dependencies for the first time. |
| `npm start` | Start the development environment |
| `npm run composer install` | Install Composer dependencies for the first time. |
| `npm run lint` | Check code style using WordPress coding standards |
| `npm run test` | Test JavaScript and PHP |
| `npm run stop` | Stop the development environment |
|-------------------------------------------------------------------------------------|

## Tests

This plugin has a small set of tests to show you how to create your own. Core WordPress code is tested, so only test the code you write.

Categories of test included in this theme:

1. **Unit** tests examine the behavior of a small unit of code.
2. **End to end** tests examine what the end user sees.
3. **Integration** tests examine compatibility between separate systems.

## wp-env

Ensure that Docker is running, then:

```shell
$ cd /path/to/a/wordpress/plugin-or-theme
$ npm -g i @wordpress/env
$ wp-env start
```

The local environment will be available at http://localhost:8888 (Username: `admin`, Password: `password`).

The database credentials are: user `root`, password `password`. For a comprehensive guide on connecting directly to the database, refer to [Accessing the MySQL Database](https://github.com/WordPress/gutenberg/blob/trunk/docs/contributors/code/getting-started-with-code-contribution.md#accessing-the-mysql-database).

For documentation on .wp-env.json options see here: https://github.com/WordPress/gutenberg/tree/trunk/packages/env#wp-envjson

## System Requirements for Development

You will need the following tools installed on your computer:

-   [Docker](https://www.docker.com/products/docker-desktop)
-   [Node.js](https://nodejs.org/en/download/)
-   [git](https://git-scm.com/downloads)

**Docker**

Windows: `winget install -e --id Docker.DockerDesktop`
Linux: `sudo apt install docker.io`
Mac with Homebrew: `brew install --cask docker`

**Node.js**

Windows: `winget install -e --id OpenJS.Nodejs`
Linux: `sudo apt install nodejs`
Mac with Homebrew: `brew install node`

**git**

Windows: `winget install -e --id Git.Git`
Linux: `sudo apt install git`
Mac with Homebrew: `brew install git`

**PHP and Composer**

PHP is not required for development, but it is useful for running Composer and other PHP scripts more quickly in your command line than in the Docker container.

I include a script for installing PHP 8.1 on Windows and Linux. You can run the script from the root of this project:

`.bin/install-php`

**WSL2 with Ubuntu**

This is optional and not needed, but I wanted to include it here because it is a great way to run Linux on Windows.

```powershell
wsl --update
wsl --install -d Ubuntu
wsl --set-version Ubuntu 2
wsl --set-default-version 2
wsl --set-default Ubuntu
```
