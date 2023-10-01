# Plugin development journal

https://github.com/WordPress/sqlite-database-integration/issues/7
date: 2023-10-01 8:26am

I posted this on the SQLite plugin's GitHub issue for improving the new site setup process:

I've resumed working on a solution which can initialize this plugin and run `<?php wp_install(); ?>` to provide a default site without asking a user to go through the site setup UI.

Would you accept a pull request if I found a way to make the plugin easier to provide this functionality natively?

If it turns out that the replacement `wp_install()` function this plugin provides does throw an error in the default PHP web server without a MySQL server being available, then I could add a conditional statement that checks for MySQL availability without throwing a database exception that halts the request.

## Use Case

If someone has no experience with WordPress, I want them to have a plugin template repository they can install and run in a few CLI commands:

```bash
.bin/install-php-and-composer.sh
composer install
.bin/prepare-wordpress-directory.sh
php -S localhost:8080 -t wordpress
```

## Issue

It's difficult to determine when to run the wp_install() function from another plugin while avoiding running core WordPress functions that attempt to access the MySQL database, thus resulting in a database access error.

## Non-PHP Solution

Running `sqlite3` from the command line to seed the database: `sqlite3 wordpress/wp-content/database/.ht.sqlite < demosite.sql`.
