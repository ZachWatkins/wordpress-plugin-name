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
INSERT INTO wp_users
VALUES(
        1,
        'admin',
        '$P$Bv.lzIyOhXWAlwgzsELai4gZBMtD.K/',
        'admin',
        'user@example.com',
        'http://localhost:8080',
        '2023-10-03 02:08:20',
        '',
        0,
        'admin'
    );
CREATE TABLE IF NOT EXISTS "wp_usermeta" (
    "umeta_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_id" integer NOT NULL DEFAULT '0',
    "meta_key" text DEFAULT NULL COLLATE NOCASE,
    "meta_value" text COLLATE NOCASE
);
INSERT INTO wp_usermeta
VALUES(1, 1, 'nickname', 'admin');
INSERT INTO wp_usermeta
VALUES(2, 1, 'first_name', '');
INSERT INTO wp_usermeta
VALUES(3, 1, 'last_name', '');
INSERT INTO wp_usermeta
VALUES(4, 1, 'description', '');
INSERT INTO wp_usermeta
VALUES(5, 1, 'rich_editing', 'true');
INSERT INTO wp_usermeta
VALUES(6, 1, 'syntax_highlighting', 'true');
INSERT INTO wp_usermeta
VALUES(7, 1, 'comment_shortcuts', 'false');
INSERT INTO wp_usermeta
VALUES(8, 1, 'admin_color', 'fresh');
INSERT INTO wp_usermeta
VALUES(9, 1, 'use_ssl', '0');
INSERT INTO wp_usermeta
VALUES(10, 1, 'show_admin_bar_front', 'true');
INSERT INTO wp_usermeta
VALUES(11, 1, 'locale', '');
INSERT INTO wp_usermeta
VALUES(
        12,
        1,
        'wp_capabilities',
        'a:1:{s:13:"administrator";b:1;}'
    );
INSERT INTO wp_usermeta
VALUES(13, 1, 'wp_user_level', '10');
INSERT INTO wp_usermeta
VALUES(14, 1, 'dismissed_wp_pointers', '');
INSERT INTO wp_usermeta
VALUES(15, 1, 'show_welcome_panel', '1');
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
INSERT INTO wp_terms
VALUES(1, 'Uncategorized', 'uncategorized', 0);
CREATE TABLE IF NOT EXISTS "wp_term_taxonomy" (
    "term_taxonomy_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "term_id" integer NOT NULL DEFAULT 0,
    "taxonomy" text NOT NULL DEFAULT '' COLLATE NOCASE,
    "description" text NOT NULL COLLATE NOCASE,
    "parent" integer NOT NULL DEFAULT 0,
    "count" integer NOT NULL DEFAULT 0
);
INSERT INTO wp_term_taxonomy
VALUES(1, 1, 'category', '', 0, 1);
CREATE TABLE IF NOT EXISTS "wp_term_relationships" (
    "object_id" integer NOT NULL DEFAULT 0,
    "term_taxonomy_id" integer NOT NULL DEFAULT 0,
    "term_order" integer NOT NULL DEFAULT 0,
    PRIMARY KEY ("object_id", "term_taxonomy_id")
);
INSERT INTO wp_term_relationships
VALUES(1, 1, 0);
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
INSERT INTO wp_comments
VALUES(
        1,
        1,
        'A WordPress Commenter',
        'wapuu@wordpress.example',
        'https://wordpress.org/',
        '',
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        replace(
            'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href="https://en.gravatar.com/">Gravatar</a>.',
            '\n',
            char(10)
        ),
        0,
        '1',
        '',
        'comment',
        0,
        0
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
INSERT INTO wp_options
VALUES(1, 'siteurl', 'http://localhost:8080', 'yes');
INSERT INTO wp_options
VALUES(2, 'home', 'http://localhost:8080', 'yes');
INSERT INTO wp_options
VALUES(
        3,
        'blogname',
        'Tim&#039;s Truck Parts and Service',
        'yes'
    );
INSERT INTO wp_options
VALUES(4, 'blogdescription', '', 'yes');
INSERT INTO wp_options
VALUES(5, 'users_can_register', '0', 'yes');
INSERT INTO wp_options
VALUES(6, 'admin_email', 'user@example.com', 'yes');
INSERT INTO wp_options
VALUES(7, 'start_of_week', '1', 'yes');
INSERT INTO wp_options
VALUES(8, 'use_balanceTags', '0', 'yes');
INSERT INTO wp_options
VALUES(9, 'use_smilies', '1', 'yes');
INSERT INTO wp_options
VALUES(10, 'require_name_email', '1', 'yes');
INSERT INTO wp_options
VALUES(11, 'comments_notify', '1', 'yes');
INSERT INTO wp_options
VALUES(12, 'posts_per_rss', '10', 'yes');
INSERT INTO wp_options
VALUES(13, 'rss_use_excerpt', '0', 'yes');
INSERT INTO wp_options
VALUES(14, 'mailserver_url', 'mail.example.com', 'yes');
INSERT INTO wp_options
VALUES(
        15,
        'mailserver_login',
        'login@example.com',
        'yes'
    );
INSERT INTO wp_options
VALUES(16, 'mailserver_pass', 'password', 'yes');
INSERT INTO wp_options
VALUES(17, 'mailserver_port', '110', 'yes');
INSERT INTO wp_options
VALUES(18, 'default_category', '1', 'yes');
INSERT INTO wp_options
VALUES(19, 'default_comment_status', 'open', 'yes');
INSERT INTO wp_options
VALUES(20, 'default_ping_status', 'open', 'yes');
INSERT INTO wp_options
VALUES(21, 'default_pingback_flag', '1', 'yes');
INSERT INTO wp_options
VALUES(22, 'posts_per_page', '10', 'yes');
INSERT INTO wp_options
VALUES(23, 'date_format', 'F j, Y', 'yes');
INSERT INTO wp_options
VALUES(24, 'time_format', 'g:i a', 'yes');
INSERT INTO wp_options
VALUES(
        25,
        'links_updated_date_format',
        'F j, Y g:i a',
        'yes'
    );
INSERT INTO wp_options
VALUES(26, 'comment_moderation', '0', 'yes');
INSERT INTO wp_options
VALUES(27, 'moderation_notify', '1', 'yes');
INSERT INTO wp_options
VALUES(28, 'permalink_structure', '', 'yes');
INSERT INTO wp_options
VALUES(29, 'rewrite_rules', '', 'yes');
INSERT INTO wp_options
VALUES(30, 'hack_file', '0', 'yes');
INSERT INTO wp_options
VALUES(31, 'blog_charset', 'UTF-8', 'yes');
INSERT INTO wp_options
VALUES(32, 'moderation_keys', '', 'no');
INSERT INTO wp_options
VALUES(33, 'active_plugins', 'a:0:{}', 'yes');
INSERT INTO wp_options
VALUES(34, 'category_base', '', 'yes');
INSERT INTO wp_options
VALUES(
        35,
        'ping_sites',
        'http://rpc.pingomatic.com/',
        'yes'
    );
INSERT INTO wp_options
VALUES(36, 'comment_max_links', '2', 'yes');
INSERT INTO wp_options
VALUES(37, 'gmt_offset', '0', 'yes');
INSERT INTO wp_options
VALUES(38, 'default_email_category', '1', 'yes');
INSERT INTO wp_options
VALUES(39, 'recently_edited', '', 'no');
INSERT INTO wp_options
VALUES(40, 'template', 'twentytwentythree', 'yes');
INSERT INTO wp_options
VALUES(41, 'stylesheet', 'twentytwentythree', 'yes');
INSERT INTO wp_options
VALUES(42, 'comment_registration', '0', 'yes');
INSERT INTO wp_options
VALUES(43, 'html_type', 'text/html', 'yes');
INSERT INTO wp_options
VALUES(44, 'use_trackback', '0', 'yes');
INSERT INTO wp_options
VALUES(45, 'default_role', 'subscriber', 'yes');
INSERT INTO wp_options
VALUES(46, 'db_version', '55853', 'yes');
INSERT INTO wp_options
VALUES(47, 'uploads_use_yearmonth_folders', '1', 'yes');
INSERT INTO wp_options
VALUES(48, 'upload_path', '', 'yes');
INSERT INTO wp_options
VALUES(49, 'blog_public', '1', 'yes');
INSERT INTO wp_options
VALUES(50, 'default_link_category', '2', 'yes');
INSERT INTO wp_options
VALUES(51, 'show_on_front', 'posts', 'yes');
INSERT INTO wp_options
VALUES(52, 'tag_base', '', 'yes');
INSERT INTO wp_options
VALUES(53, 'show_avatars', '1', 'yes');
INSERT INTO wp_options
VALUES(54, 'avatar_rating', 'G', 'yes');
INSERT INTO wp_options
VALUES(55, 'upload_url_path', '', 'yes');
INSERT INTO wp_options
VALUES(56, 'thumbnail_size_w', '150', 'yes');
INSERT INTO wp_options
VALUES(57, 'thumbnail_size_h', '150', 'yes');
INSERT INTO wp_options
VALUES(58, 'thumbnail_crop', '1', 'yes');
INSERT INTO wp_options
VALUES(59, 'medium_size_w', '300', 'yes');
INSERT INTO wp_options
VALUES(60, 'medium_size_h', '300', 'yes');
INSERT INTO wp_options
VALUES(61, 'avatar_default', 'mystery', 'yes');
INSERT INTO wp_options
VALUES(62, 'large_size_w', '1024', 'yes');
INSERT INTO wp_options
VALUES(63, 'large_size_h', '1024', 'yes');
INSERT INTO wp_options
VALUES(64, 'image_default_link_type', 'none', 'yes');
INSERT INTO wp_options
VALUES(65, 'image_default_size', '', 'yes');
INSERT INTO wp_options
VALUES(66, 'image_default_align', '', 'yes');
INSERT INTO wp_options
VALUES(67, 'close_comments_for_old_posts', '0', 'yes');
INSERT INTO wp_options
VALUES(68, 'close_comments_days_old', '14', 'yes');
INSERT INTO wp_options
VALUES(69, 'thread_comments', '1', 'yes');
INSERT INTO wp_options
VALUES(70, 'thread_comments_depth', '5', 'yes');
INSERT INTO wp_options
VALUES(71, 'page_comments', '0', 'yes');
INSERT INTO wp_options
VALUES(72, 'comments_per_page', '50', 'yes');
INSERT INTO wp_options
VALUES(73, 'default_comments_page', 'newest', 'yes');
INSERT INTO wp_options
VALUES(74, 'comment_order', 'asc', 'yes');
INSERT INTO wp_options
VALUES(75, 'sticky_posts', 'a:0:{}', 'yes');
INSERT INTO wp_options
VALUES(76, 'widget_categories', 'a:0:{}', 'yes');
INSERT INTO wp_options
VALUES(77, 'widget_text', 'a:0:{}', 'yes');
INSERT INTO wp_options
VALUES(78, 'widget_rss', 'a:0:{}', 'yes');
INSERT INTO wp_options
VALUES(79, 'uninstall_plugins', 'a:0:{}', 'no');
INSERT INTO wp_options
VALUES(80, 'timezone_string', '', 'yes');
INSERT INTO wp_options
VALUES(81, 'page_for_posts', '0', 'yes');
INSERT INTO wp_options
VALUES(82, 'page_on_front', '0', 'yes');
INSERT INTO wp_options
VALUES(83, 'default_post_format', '0', 'yes');
INSERT INTO wp_options
VALUES(84, 'link_manager_enabled', '0', 'yes');
INSERT INTO wp_options
VALUES(
        85,
        'finished_splitting_shared_terms',
        '1',
        'yes'
    );
INSERT INTO wp_options
VALUES(86, 'site_icon', '0', 'yes');
INSERT INTO wp_options
VALUES(87, 'medium_large_size_w', '768', 'yes');
INSERT INTO wp_options
VALUES(88, 'medium_large_size_h', '0', 'yes');
INSERT INTO wp_options
VALUES(89, 'wp_page_for_privacy_policy', '3', 'yes');
INSERT INTO wp_options
VALUES(90, 'show_comments_cookies_opt_in', '1', 'yes');
INSERT INTO wp_options
VALUES(91, 'admin_email_lifespan', '1711850893', 'yes');
INSERT INTO wp_options
VALUES(92, 'disallowed_keys', '', 'no');
INSERT INTO wp_options
VALUES(93, 'comment_previously_approved', '1', 'yes');
INSERT INTO wp_options
VALUES(
        94,
        'auto_plugin_theme_update_emails',
        'a:0:{}',
        'no'
    );
INSERT INTO wp_options
VALUES(95, 'auto_update_core_dev', 'enabled', 'yes');
INSERT INTO wp_options
VALUES(96, 'auto_update_core_minor', 'enabled', 'yes');
INSERT INTO wp_options
VALUES(97, 'auto_update_core_major', 'enabled', 'yes');
INSERT INTO wp_options
VALUES(
        98,
        'wp_force_deactivated_plugins',
        'a:0:{}',
        'yes'
    );
INSERT INTO wp_options
VALUES(99, 'initial_db_version', '55853', 'yes');
INSERT INTO wp_options
VALUES(
        100,
        'wp_user_roles',
        'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}',
        'yes'
    );
INSERT INTO wp_options
VALUES(101, 'fresh_site', '1', 'yes');
INSERT INTO wp_options
VALUES(102, 'user_count', '1', 'no');
INSERT INTO wp_options
VALUES(
        103,
        'widget_block',
        'a:6:{i:2;a:1:{s:7:"content";s:19:"<!-- wp:search /-->";}i:3;a:1:{s:7:"content";s:154:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->";}i:4;a:1:{s:7:"content";s:227:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {"displayAvatar":false,"displayDate":false,"displayExcerpt":false} /--></div><!-- /wp:group -->";}i:5;a:1:{s:7:"content";s:146:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->";}i:6;a:1:{s:7:"content";s:150:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->";}s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        104,
        'sidebars_widgets',
        'a:4:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:3:{i:0;s:7:"block-2";i:1;s:7:"block-3";i:2;s:7:"block-4";}s:9:"sidebar-2";a:2:{i:0;s:7:"block-5";i:1;s:7:"block-6";}s:13:"array_version";i:3;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        105,
        'cron',
        'a:5:{i:1696302516;a:1:{s:34:"wp_privacy_delete_old_export_files";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"hourly";s:4:"args";a:0:{}s:8:"interval";i:3600;}}}i:1696342116;a:2:{s:18:"wp_https_detection";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1696342117;a:2:{s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1696385316;a:1:{s:30:"wp_site_health_scheduled_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"weekly";s:4:"args";a:0:{}s:8:"interval";i:604800;}}}s:7:"version";i:2;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        106,
        'widget_pages',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        107,
        'widget_calendar',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        108,
        'widget_archives',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        109,
        'widget_media_audio',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        110,
        'widget_media_image',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        111,
        'widget_media_gallery',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        112,
        'widget_media_video',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        113,
        'widget_meta',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        114,
        'widget_search',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        115,
        'widget_recent-posts',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        116,
        'widget_recent-comments',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        117,
        'widget_tag_cloud',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        118,
        'widget_nav_menu',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        119,
        'widget_custom_html',
        'a:1:{s:12:"_multiwidget";i:1;}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        120,
        'nonce_key',
        'D3SCC?xF52>^Fe.T4HaFoCP`~P:<3%6hy6V1!aQ7>AKJxY-43r;[45noJTeFc zt',
        'no'
    );
INSERT INTO wp_options
VALUES(
        121,
        'nonce_salt',
        'Lm#?zs{b)x4E@W}jv>Q$P}h# uz?`i2|Yqsyt[-rIyIx@Zc&9Yh!}HvF}toA).kK',
        'no'
    );
INSERT INTO wp_options
VALUES(
        123,
        'https_detection_errors',
        'a:1:{s:20:"https_request_failed";a:1:{i:0;s:21:"HTTPS request failed.";}}',
        'yes'
    );
INSERT INTO wp_options
VALUES(
        127,
        '_site_transient_timeout_theme_roots',
        '1696300733',
        'no'
    );
INSERT INTO wp_options
VALUES(
        128,
        '_site_transient_theme_roots',
        'a:0:{}',
        'no'
    );
INSERT INTO wp_options
VALUES(
        130,
        '_site_transient_update_core',
        'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:65:"https://downloads.wordpress.org/release/en_CA/wordpress-6.3.1.zip";s:6:"locale";s:5:"en_CA";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:65:"https://downloads.wordpress.org/release/en_CA/wordpress-6.3.1.zip";s:10:"no_content";s:0:"";s:11:"new_bundled";s:0:"";s:7:"partial";s:0:"";s:8:"rollback";s:0:"";}s:7:"current";s:5:"6.3.1";s:7:"version";s:5:"6.3.1";s:11:"php_version";s:5:"7.0.0";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"6.1";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1696298934;s:15:"version_checked";s:5:"6.3.1";s:12:"translations";a:1:{i:0;a:7:{s:4:"type";s:4:"core";s:4:"slug";s:7:"default";s:8:"language";s:5:"en_CA";s:7:"version";s:5:"6.3.1";s:7:"updated";s:19:"2023-08-03 07:25:21";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/6.3.1/en_CA.zip";s:10:"autoupdate";b:1;}}}',
        'no'
    );
INSERT INTO wp_options
VALUES(
        131,
        '_site_transient_update_themes',
        'O:8:"stdClass":1:{s:12:"last_checked";i:1696298934;}',
        'no'
    );
INSERT INTO wp_options
VALUES(
        132,
        '_site_transient_update_plugins',
        'O:8:"stdClass":5:{s:12:"last_checked";i:1696298936;s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:1:{s:36:"sqlite-database-integration/load.php";O:8:"stdClass":10:{s:2:"id";s:41:"w.org/plugins/sqlite-database-integration";s:4:"slug";s:27:"sqlite-database-integration";s:6:"plugin";s:36:"sqlite-database-integration/load.php";s:11:"new_version";s:5:"2.1.1";s:3:"url";s:58:"https://wordpress.org/plugins/sqlite-database-integration/";s:7:"package";s:70:"https://downloads.wordpress.org/plugin/sqlite-database-integration.zip";s:5:"icons";a:1:{s:7:"default";s:71:"https://s.w.org/plugins/geopattern-icon/sqlite-database-integration.svg";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}s:8:"requires";s:3:"6.0";}}s:7:"checked";a:2:{s:36:"sqlite-database-integration/load.php";s:5:"2.1.1";s:47:"wordpress-plugin-name/wordpress-plugin-name.php";s:5:"1.0.0";}}',
        'no'
    );
CREATE TABLE IF NOT EXISTS "wp_postmeta" (
    "meta_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
    "post_id" integer NOT NULL DEFAULT '0',
    "meta_key" text DEFAULT NULL COLLATE NOCASE,
    "meta_value" text COLLATE NOCASE
);
INSERT INTO wp_postmeta
VALUES(1, 2, '_wp_page_template', 'default');
INSERT INTO wp_postmeta
VALUES(2, 3, '_wp_page_template', 'default');
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
INSERT INTO wp_posts
VALUES(
        1,
        1,
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        replace(
            '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->',
            '\n',
            char(10)
        ),
        'Hello world!',
        '',
        'publish',
        'open',
        'open',
        '',
        'hello-world',
        '',
        '',
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        '',
        0,
        'http://localhost:8080/?p=1',
        0,
        'post',
        '',
        1
    );
INSERT INTO wp_posts
VALUES(
        2,
        1,
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        replace(
            '<!-- wp:paragraph -->\n<p>This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class="wp-block-quote"><p>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class="wp-block-quote"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href="http://localhost:8080/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->',
            '\n',
            char(10)
        ),
        'Sample Page',
        '',
        'publish',
        'closed',
        'open',
        '',
        'sample-page',
        '',
        '',
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        '',
        0,
        'http://localhost:8080/?page_id=2',
        0,
        'page',
        '',
        0
    );
INSERT INTO wp_posts
VALUES(
        3,
        1,
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        '<!-- wp:heading --><h2>Who we are</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>Our website address is: http://localhost:8080.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Comments</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Media</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Cookies</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Embedded content from other websites</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Who we share your data with</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>How long we retain your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What rights you have over your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where your data is sent</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class="privacy-policy-tutorial">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p><!-- /wp:paragraph -->',
        'Privacy Policy',
        '',
        'draft',
        'closed',
        'open',
        '',
        'privacy-policy',
        '',
        '',
        '2023-10-03 02:08:21',
        '2023-10-03 02:08:21',
        '',
        0,
        'http://localhost:8080/?page_id=3',
        0,
        'page',
        '',
        0
    );
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence
VALUES('wp_options', 132);
INSERT INTO sqlite_sequence
VALUES('wp_users', 1);
INSERT INTO sqlite_sequence
VALUES('wp_usermeta', 15);
INSERT INTO sqlite_sequence
VALUES('wp_terms', 1);
INSERT INTO sqlite_sequence
VALUES('wp_term_taxonomy', 1);
INSERT INTO sqlite_sequence
VALUES('wp_posts', 3);
INSERT INTO sqlite_sequence
VALUES('wp_comments', 1);
INSERT INTO sqlite_sequence
VALUES('wp_postmeta', 2);
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
