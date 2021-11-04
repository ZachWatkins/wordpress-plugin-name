# WordPress Plugin Boilerplate

An introduction to WordPress plugin development.

## Features

1. Plugin compatibility headers
2. Well documented code using [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) and links to official PHP and WordPress documentation websites that can help beginners learn the code more quickly.
3. Visual Studio Code and Composer modules for PHP and WordPress Coding Standards and core documentation preconfigured for an improved in-editor learning experience.
4. Essential WordPress features that beginners are likely to want to learn:
   a. A plugin activation class that ensures Advanced Custom Fields lite or pro is activated before allowing this plugin to activate.  
   b. A page template registration class that throws exceptions if misconfigured during development.  
   c. A page template file that loads and extends a site's `page.php` template and adds content with action hooks for maximum theme compatibility.  
   d. A demo template with Advanced Custom Fields, CSS, jQuery, and a JS file.

## Installation

Before you get started you should download and install some things:

*Windows*
1. Install Microsoft Visual Studio Code: <https://code.visualstudio.com/>.
2. Install PHP 7.4 using the Microsoft Web Platform Installer: <https://www.microsoft.com/web/downloads/platform.aspx>.
3. Install Composer for PHP using Composer-Setup.exe*: <https://getcomposer.org/doc/00-intro.md#installation-windows>.
4. Install Sourcetree <https://www.sourcetreeapp.com/>.
5. Clone this repository to your computer using Sourcetree.
6. Open the "workspace" in Microsoft Visual Studio Code and install the workspace's recommended Extensions.

*Repository*
1. Run `$ composer install` from this directory on the command line.
2. Restart VS Code if you have it open.

## Introduction

"Welcome to the WordPress Plugin Developer Handbook; are you ready to jump right in to the world of WordPress plugins?

"The Plugin Developer Handbook is a resource for all things WordPress plugins. Whether you’re new to WordPress plugin development, or you’re an experienced plugin developer, you should be able to find the answer to many of your plugin-related questions right here." View more: <https://developer.wordpress.org/plugins/>

This plugin was created by Zachary Watkins <watkinza@gmail.com> with the hope that it could be someone's first step into WordPress development.

## Principles of Software Development

These principles can be looked up for better explanation and are provided here as a suggestion for self-guided learning.
1. Separation of Concerns
2. Don't Repeat Yourself
3. Single Responsibility Principle
4. Avoid clever code (i.e. prefer simple, intuitive logic over complicated code)
5. Premature optimization is the root of all evil

### Separation of Concerns

This is a key principle of software development and involves separating code in a logical way for the purpose of reducing the burden required to maintain it. How or why to separate code is subjective and while there are best practices and standards it is ultimately up to the maintainers. The number of files may seem intimidating until you remember this is done with the goal of adding simplicity, not taking away from it.

"[Separation of Concerns], even if not perfectly possible, is yet the only available technique for effective ordering of one's thoughts, that I know of." -- Edsger W. Dijkstra

### Don't Repeat Yourself

If you plan to re-use code you have created, try to package it so that you can call upon it as a reference instead of needing to copy and paste the code again in a different file. This will help with the maintainability of that code and wherever it will be used.

### Single Responsibility Principle

"It is a software engineering principle that states that a class should have only one reason to change. In other words, it must have only one responsibility.

"Here, we are talking about cohesion. All elements in given class structures or modules should have a functional affinity to one another. By clearly defining your class’s responsibility, you increase its cohesiveness."

- Jerome Rault, "10 Crucial Software Development Principles to Live By", <https://www.laneways.agency/software-development-principles/>

## Code Standards, Guidelines, and Conventions

There are many ways to learn programming and rigid documentation requirements can seem daunting for beginners. If you are a beginner, I am excited that you are here and I hope you learn something from what you find here. While not a requirement to write functional code, the additional steps required to learn and implement best practices for documentation is worthwhile for both personal and professional projects.

"WordPress is a big project with thousands of contributors. It’s important that best practices are followed so that the codebase is consistent and readable, and changes are easy to find and read, whether the code is five days old or five years old. What follows are a series of best practices to help keep WordPress code clean and well documented for years to come." View more: <https://developer.wordpress.org/coding-standards/>

"WordPress uses a customized documentation schema that draws inspiration from PHPDoc, an evolving standard for providing documentation to PHP code, which is maintained by [phpDocumentor](http://phpdoc.org/)." View more: <https://developer.wordpress.org/coding-standards/inline-documentation-standards/php/>

PHPDoc's Tag Reference: <https://docs.phpdoc.org/3.0/guide/references/phpdoc/tags/index.html#tag-reference>

I use the Composer module for [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/) to automate code compliance with [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/). However, this repository is not yet fully compliant with those standards. A pre-commit hook file is included in this repository to enforce code commits to meet this standard but can be disabled when a situation warrants it, such as backing up unfinished work via a commit.

Git, NPM, and Visual Studio Code files in this repository help improve compatibility between Mac (terminal) and Windows (powershell) environments for improved collaboration between developers.

Line endings are converted to Linux-style LF "\n" when committed to the repository using the `.gitattributes` file. This is what WordPress requires for its Subversion version control system, and Subversion is how developers submit WordPress plugins and themes to the official WordPress.org library. This is an important feature because Windows computers add "\r\n" characters to the end of text lines when a line is broken. View more: http://git-scm.com/docs/gitattributes#_end_of_line_conversion

Links to resources:

* WordPress Coding Standards - <https://developer.wordpress.org/coding-standards/>
* WordPress Codex - File Header - <https://codex.wordpress.org/File_Header>
* PHPDoc Reference - <https://docs.phpdoc.org/3.0/guide/references/phpdoc/index.html>
* Sass Lint Reference - <https://github.com/sasstools/sass-lint> (abandoned but stable)
* PHP CodeSniffer Wiki - <https://github.com/squizlabs/PHP_CodeSniffer/wiki/Usage>
* NPM package schema - <https://docs.npmjs.com/cli/v7/configuring-npm/package-json>
* Composer package schema - <https://getcomposer.org/doc/04-schema.md>
* The Software Package Data Exchange:reg: - <https://spdx.dev/>
