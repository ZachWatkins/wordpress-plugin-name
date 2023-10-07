# WordPress Plugin Template

This plugin is a template for creating a WordPress plugin. It is a fully working plugin itself, but it has very limited functionality. It only includes a starting point for features that you may want to implement in your own plugin. Remove features that you will not need and then extend the features you keep or add your own.

The goal is to provide a reliable, portable codebase with well-defined dependencies and minimal time for someone to make their first contribution even if they have never seen this code before.

_Note: if using `git` with SSH credentials, you may need to use an SSH style URL (git@github.com:zachwatkins/wordpress-plugin-name.git) instead of HTTPS (https://github.com/zachwatkins/wordpress-plugin-name.git)._

**Table of Contents**

-   [Developer Installation](#developer-installation)
-   [Creating a New Plugin](#creating-a-new-plugin)
-   [Directory Structure](#directory-structure)
-   [Commands](#commands)
-   [Tests](#tests)
-   [Installing System Requirements for Development](#system-requirements-for-development)
-   [Further Reading](#further-reading)

## Developer Installation

### Docker

Run the commands below and then open your browser to [http://localhost:8888](http://localhost:8888). Your username and password are `admin -> password`.

```shell
git clone https://github.com/zachwatkins/wordpress-plugin-name
cd your-plugin-name
npm install
npm start
```

### Local

```shell
cd ~/Local Sites/your-site/app/public/wp-content/plugins
git clone https://github.com/zachwatkins/wordpress-plugin-name
cd wordpress-plugin-name
npm install
composer install
```

## Creating a New Plugin

_Note: You can remove this section from your new plugin's documentation._

To create your own plugin using this template, choose one of the approaches below. If you have not done so already, rename git's default branch name: `git config --global init.defaultBranch main`

### Docker

```shell
git clone https://github.com/zachwatkins/wordpress-plugin-name your-plugin-name
cd your-plugin-name
rm -rf .git
npm run template
git init
git add .
git commit -m "initial commit"
git branch -M main
git remote add origin https://github.com/ttitamu/your-plugin-name.git
git push -u origin main
npm install
npm start
```

### Local

```shell
cd ~/Local Sites/your-site/app/public/wp-content/plugins
git clone https://github.com/zachwatkins/wordpress-plugin-name your-plugin-name
cd your-plugin-name
rm -rf .git
npm run template
git init
git add .
git commit -m "initial commit"
git branch -M main
git remote add origin https://github.com/ttitamu/your-plugin-name.git
git push -u origin main
npm install
composer install
```

## Directory Structure

1. **.bin** - Custom scripts for local development.
2. **.config** - Configuration files for development tools used in this project.
3. **.github** - GitHub integration files such as Actions workflows.
4. **.vscode** - Visual Studio Code integration files.
5. **.wp-env** - WordPress development environment default content.
6. **config** - Configuration file for a settings page feature.
7. **docs** - Documentation files going in depth on different aspects of this project or WordPress development.
8. **library** - A library of common WordPress feature implementations that I'm developing alongside this template plugin. Do not modify them - treat this directory as an external library.
9. **src** - Source code for the plugin's features, aside from the settings page feature and the library.
10. **src/admin** - Source code for features specific to the admin user interface.
11. **src/admin/views** - Files which render HTML for the admin user interface.
12. **src/assets** - Non-PHP files used by the plugin, such as JavaScript, CSS, and images.
13. **src/views** - Files which render HTML for site visitors.
14. **src/demo.php** - Inserts demo content into your website to demonstrate your plugin's features during development.
15. **test** - Plugin code tests.  
    a. **e2e** - Browser tests using Playwright.  
    b. **jest** - JavaScript tests using Jest.  
    c. **phpunit** - WordPress PHP code tests using PHPUnit.
16. **index.php** - The entrypoint for your plugin. This file is loaded by WordPress when the plugin is active for a site.

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

The links below describe important WordPress code concepts you may need to know when developing your WordPress plugin.

-   [Action Hooks](https://developer.wordpress.org/plugins/hooks/actions/)
-   [Filter Hooks](https://developer.wordpress.org/plugins/hooks/filters/)
-   [Shortcodes](https://developer.wordpress.org/plugins/shortcodes/)
-   [Options API](https://developer.wordpress.org/plugins/settings/options-api/)
-   [Custom Post Types](https://developer.wordpress.org/plugins/post-types/)
-   [Custom Taxonomies](https://developer.wordpress.org/plugins/taxonomies/)
-   [`@wordpress/env`](https://github.com/WordPress/gutenberg/tree/trunk/packages/env)
