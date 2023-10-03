# Using an SQLite database with WordPress.

To avoid using Docker to test WordPress plugins and themes, we are using an official (though early development) plugin which enables a WordPress site to use an SQLite database.

https://github.com/WordPress/sqlite-database-integration/

Call for testing: https://make.wordpress.org/core/2022/12/20/help-us-test-the-sqlite-implementation/

## SQLite CLI commands

To export an SQLite database to a file:

```shell
sqlite3 database.sqlite .dump > database.sql
```
