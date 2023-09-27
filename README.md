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

Follow the steps below to create a new WordPress plugin from this template (assuming the new plugin is named "New Plugin Name").

1. `git clone https://github.com/zachwatkins/wordpress-plugin-template new-plugin-name`
2. `cd new-plugin-name`
3. `rm -rf .git`
4. `git init`
5. `git add .`
6. `git commit -m "Initial commit"`
7. `git branch -M main`
8. `git remote add origin https://github.com/zachwatkins/new-plugin-name.git`
9. `git push -u origin main`
10. `npm run template`
11. `npm install`
12. `npm start`

## Directory Structure

1. **.bin** - Custom scripts for local development.
2. **.config** - Configuration files for development tools used in this project.
3. **.github** - GitHub integration files such as Actions workflows.
4. **.vscode** - Visual Studio Code integration files.
5. **.wp-env** - WordPress development environment default content.
6. **advanced-custom-fields** - Advanced Custom Fields field registration and import files.
7. **assets** - JavaScript, CSS, images, fonts, and other static files.
8. **common** - Common WordPress feature implementations that you can copy and modify for your plugin.
9. **docs** - Documentation files going in depth on different aspects of this project or WordPress development.
10. **includes** - File content output to the browser by the plugin. This is where you should put most or all of the HTML output from your plugin, to make that content easier to find and change.
11. **src** - PHP classes that hook into WordPress and implement plugin features.
12. **test** - Plugin code tests.  
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
| `npm run lint` | Check JS and CSS code style using WordPress coding standards |
| `npm run lint:php` | Check PHP code style using WordPress coding standards |
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
-   [Node.js](https://nodejs.org/en/download/) or [NVM](https://github.com/nvm-sh/nvm)
-   [git](https://git-scm.com/downloads)

To make this easier, you can use an installer included in this repository by saving it to your computer and making it executable.
You must have administrator rights to run these installers.

### Mac Installation

1. Copy this file to your computer: [.bin/install/mac.sh](.bin/install/mac.sh)
2. Open your terminal and navigate to the directory where you saved the file.
3. Make the file executable: `chmod +x mac.sh`
4. Run the file: `./mac.sh`

### Windows Installation

1. Copy this file to your computer: [.bin/install/windows.bat](.bin/install/windows.bat)
2. Open your terminal and navigate to the directory where you saved the file.
3. Run the file: `windows.bat`

## Further Reading

The links below describe key WordPress code concepts you will need to know in order to develop your WordPress plugin.

-   [Action Hooks](https://developer.wordpress.org/plugins/hooks/actions/)
-   [Filter Hooks](https://developer.wordpress.org/plugins/hooks/filters/)
