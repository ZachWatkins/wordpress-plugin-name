PRAGMA foreign_keys = OFF;
BEGIN TRANSACTION;
CREATE TABLE _mysql_data_types_cache (
    `table` TEXT NOT NULL,
    `column_or_index` TEXT NOT NULL,
    `mysql_type` TEXT NOT NULL,
    PRIMARY KEY(`table`, `column_or_index`)
);
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'ID', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_login', 'varchar(60)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_pass', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_nicename', 'varchar(50)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_email', 'varchar(100)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_url', 'varchar(100)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_registered', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_users',
        'user_activation_key',
        'varchar(255)'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'user_status', 'int(11)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'display_name', 'varchar(250)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'wp_users__user_login_key', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'wp_users__user_nicename', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_users', 'wp_users__user_email', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_usermeta', 'umeta_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_usermeta', 'user_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_usermeta', 'meta_key', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_usermeta', 'meta_value', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_usermeta', 'wp_usermeta__user_id', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_usermeta', 'wp_usermeta__meta_key', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_termmeta', 'meta_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_termmeta', 'term_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_termmeta', 'meta_key', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_termmeta', 'meta_value', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_termmeta', 'wp_termmeta__term_id', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_termmeta', 'wp_termmeta__meta_key', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_terms', 'term_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_terms', 'name', 'varchar(200)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_terms', 'slug', 'varchar(200)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_terms', 'term_group', 'bigint(10)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_terms', 'wp_terms__slug', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_terms', 'wp_terms__name', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_taxonomy',
        'term_taxonomy_id',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_taxonomy',
        'term_id',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_term_taxonomy', 'taxonomy', 'varchar(32)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_term_taxonomy', 'description', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_taxonomy',
        'parent',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_term_taxonomy', 'count', 'bigint(20)');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_taxonomy',
        'wp_term_taxonomy__term_id_taxonomy',
        'UNIQUE'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_taxonomy',
        'wp_term_taxonomy__taxonomy',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_relationships',
        'object_id',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_relationships',
        'term_taxonomy_id',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_term_relationships', 'term_order', 'int(11)');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_term_relationships',
        'wp_term_relationships__term_taxonomy_id',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_commentmeta',
        'meta_id',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_commentmeta',
        'comment_id',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_commentmeta', 'meta_key', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_commentmeta', 'meta_value', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_commentmeta',
        'wp_commentmeta__comment_id',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_commentmeta',
        'wp_commentmeta__meta_key',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'comment_ID',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'comment_post_ID',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_author', 'tinytext');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'comment_author_email',
        'varchar(100)'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'comment_author_url',
        'varchar(200)'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'comment_author_IP',
        'varchar(100)'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_date', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_date_gmt', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_content', 'text');
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_karma', 'int(11)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_approved', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_agent', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'comment_type', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'comment_parent',
        'bigint(20) unsigned'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_comments', 'user_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'wp_comments__comment_post_ID',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'wp_comments__comment_approved_date_gmt',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'wp_comments__comment_date_gmt',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'wp_comments__comment_parent',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_comments',
        'wp_comments__comment_author_email',
        'KEY'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_url', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_name', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_image', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_target', 'varchar(25)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_description', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_visible', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_owner', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_rating', 'int(11)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_updated', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_rel', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_notes', 'mediumtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'link_rss', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_links', 'wp_links__link_visible', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_options', 'option_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_options', 'option_name', 'varchar(191)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_options', 'option_value', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_options', 'autoload', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES(
        'wp_options',
        'wp_options__option_name',
        'UNIQUE'
    );
INSERT INTO _mysql_data_types_cache
VALUES('wp_options', 'wp_options__autoload', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_postmeta', 'meta_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_postmeta', 'post_id', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_postmeta', 'meta_key', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_postmeta', 'meta_value', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_postmeta', 'wp_postmeta__post_id', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_postmeta', 'wp_postmeta__meta_key', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'ID', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_author', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_date', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_date_gmt', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_content', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_title', 'text');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_excerpt', 'text');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_status', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'comment_status', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'ping_status', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_password', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_name', 'varchar(200)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'to_ping', 'text');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'pinged', 'text');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_modified', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_modified_gmt', 'datetime');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_content_filtered', 'longtext');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_parent', 'bigint(20) unsigned');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'guid', 'varchar(255)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'menu_order', 'int(11)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_type', 'varchar(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'post_mime_type', 'varchar(100)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'comment_count', 'bigint(20)');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'wp_posts__post_name', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'wp_posts__type_status_date', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'wp_posts__post_parent', 'KEY');
INSERT INTO _mysql_data_types_cache
VALUES('wp_posts', 'wp_posts__post_author', 'KEY');
CREATE TABLE IF NOT EXISTS "wp_users" (
    "ID" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_login" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "user_pass" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "user_nicename" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "user_email" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "user_url" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "user_registered" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "user_activation_key" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "user_status" integer NOT NULL DEFAULT '0',
    "display_name" text NOT NULL DEFAULT '' COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_usermeta" (
    "umeta_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_id" integer NOT NULL DEFAULT '0',
    "meta_key" text DEFAULT NULL COLLATE NOCASE,
    "meta_value" text COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_termmeta" (
    "meta_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "term_id" integer NOT NULL DEFAULT '0',
    "meta_key" text DEFAULT NULL COLLATE NOCASE,
    "meta_value" text COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_terms" (
    "term_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "slug" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "term_group" integer NOT NULL DEFAULT 0
);
CREATE TABLE IF NOT EXISTS "wp_term_taxonomy" (
    "term_taxonomy_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "term_id" integer NOT NULL DEFAULT 0,
    "taxonomy" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "description" text NOT NULL COLLATE NOCASE,
    "parent" integer NOT NULL DEFAULT 0,
    "count" integer NOT NULL DEFAULT 0
);
CREATE TABLE IF NOT EXISTS "wp_term_relationships" (
    "object_id" integer NOT NULL DEFAULT 0,
    "term_taxonomy_id" integer NOT NULL DEFAULT 0,
    "term_order" integer NOT NULL DEFAULT 0,
    PRIMARY KEY ("object_id", "term_taxonomy_id")
);
CREATE TABLE IF NOT EXISTS "wp_commentmeta" (
    "meta_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "comment_id" integer NOT NULL DEFAULT '0',
    "meta_key" text DEFAULT NULL COLLATE NOCASE,
    "meta_value" text COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_comments" (
    "comment_ID" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "comment_post_ID" integer NOT NULL DEFAULT '0',
    "comment_author" text NOT NULL COLLATE NOCASE,
    "comment_author_email" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "comment_author_url" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "comment_author_IP" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "comment_date" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "comment_date_gmt" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "comment_content" text NOT NULL COLLATE NOCASE,
    "comment_karma" integer NOT NULL DEFAULT '0',
    "comment_approved" text NOT NULL DEFAULT '1' COLLATE NOCASE,
    "comment_agent" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "comment_type" text NOT NULL DEFAULT 'comment' COLLATE NOCASE,
    "comment_parent" integer NOT NULL DEFAULT '0',
    "user_id" integer NOT NULL DEFAULT '0'
);
CREATE TABLE IF NOT EXISTS "wp_links" (
    "link_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "link_url" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "link_name" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "link_image" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "link_target" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "link_description" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "link_visible" text NOT NULL DEFAULT 'Y' COLLATE NOCASE,
    "link_owner" integer NOT NULL DEFAULT '1',
    "link_rating" integer NOT NULL DEFAULT '0',
    "link_updated" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "link_rel" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "link_notes" text NOT NULL COLLATE NOCASE,
    "link_rss" text NOT NULL DEFAULT '' COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_options" (
    "option_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "option_name" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "option_value" text NOT NULL COLLATE NOCASE,
    "autoload" text NOT NULL DEFAULT 'yes' COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_postmeta" (
    "meta_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "post_id" integer NOT NULL DEFAULT '0',
    "meta_key" text DEFAULT NULL COLLATE NOCASE,
    "meta_value" text COLLATE NOCASE
);
CREATE TABLE IF NOT EXISTS "wp_posts" (
    "ID" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "post_author" integer NOT NULL DEFAULT '0',
    "post_date" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "post_date_gmt" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "post_content" text NOT NULL COLLATE NOCASE,
    "post_title" text NOT NULL COLLATE NOCASE,
    "post_excerpt" text NOT NULL COLLATE NOCASE,
    "post_status" text NOT NULL DEFAULT 'publish' COLLATE NOCASE,
    "comment_status" text NOT NULL DEFAULT 'open' COLLATE NOCASE,
    "ping_status" text NOT NULL DEFAULT 'open' COLLATE NOCASE,
    "post_password" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "post_name" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "to_ping" text NOT NULL COLLATE NOCASE,
    "pinged" text NOT NULL COLLATE NOCASE,
    "post_modified" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "post_modified_gmt" text NOT NULL DEFAULT '0000-00-00 00:00:00' COLLATE NOCASE,
    "post_content_filtered" text NOT NULL COLLATE NOCASE,
    "post_parent" integer NOT NULL DEFAULT '0',
    "guid" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "menu_order" integer NOT NULL DEFAULT '0',
    "post_type" text NOT NULL DEFAULT 'post' COLLATE NOCASE,
    "post_mime_type" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "comment_count" integer NOT NULL DEFAULT '0'
);
CREATE INDEX "wp_users__user_login_key" ON "wp_users" ("user_login");
CREATE INDEX "wp_users__user_nicename" ON "wp_users" ("user_nicename");
CREATE INDEX "wp_users__user_email" ON "wp_users" ("user_email");
CREATE INDEX "wp_usermeta__user_id" ON "wp_usermeta" ("user_id");
CREATE INDEX "wp_usermeta__meta_key" ON "wp_usermeta" ("meta_key");
CREATE INDEX "wp_termmeta__term_id" ON "wp_termmeta" ("term_id");
CREATE INDEX "wp_termmeta__meta_key" ON "wp_termmeta" ("meta_key");
CREATE INDEX "wp_terms__slug" ON "wp_terms" ("slug");
CREATE INDEX "wp_terms__name" ON "wp_terms" ("name");
CREATE UNIQUE INDEX "wp_term_taxonomy__term_id_taxonomy" ON "wp_term_taxonomy" ("term_id", "taxonomy");
CREATE INDEX "wp_term_taxonomy__taxonomy" ON "wp_term_taxonomy" ("taxonomy");
CREATE INDEX "wp_term_relationships__term_taxonomy_id" ON "wp_term_relationships" ("term_taxonomy_id");
CREATE INDEX "wp_commentmeta__comment_id" ON "wp_commentmeta" ("comment_id");
CREATE INDEX "wp_commentmeta__meta_key" ON "wp_commentmeta" ("meta_key");
CREATE INDEX "wp_comments__comment_post_ID" ON "wp_comments" ("comment_post_ID");
CREATE INDEX "wp_comments__comment_approved_date_gmt" ON "wp_comments" ("comment_approved", "comment_date_gmt");
CREATE INDEX "wp_comments__comment_date_gmt" ON "wp_comments" ("comment_date_gmt");
CREATE INDEX "wp_comments__comment_parent" ON "wp_comments" ("comment_parent");
CREATE INDEX "wp_comments__comment_author_email" ON "wp_comments" ("comment_author_email");
CREATE INDEX "wp_links__link_visible" ON "wp_links" ("link_visible");
CREATE UNIQUE INDEX "wp_options__option_name" ON "wp_options" ("option_name");
CREATE INDEX "wp_options__autoload" ON "wp_options" ("autoload");
CREATE INDEX "wp_postmeta__post_id" ON "wp_postmeta" ("post_id");
CREATE INDEX "wp_postmeta__meta_key" ON "wp_postmeta" ("meta_key");
CREATE INDEX "wp_posts__post_name" ON "wp_posts" ("post_name");
CREATE INDEX "wp_posts__type_status_date" ON "wp_posts" ("post_type", "post_status", "post_date", "ID");
CREATE INDEX "wp_posts__post_parent" ON "wp_posts" ("post_parent");
CREATE INDEX "wp_posts__post_author" ON "wp_posts" ("post_author");
COMMIT;
