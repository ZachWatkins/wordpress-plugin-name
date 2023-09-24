/**
 * Command line application to change the name of this plugin from "wordpress-plugin-name" to something else.
 * @author Zachary K. Watkins <zwatkins.it@gmail.com>
 * @year 2023
 */

import fs from 'fs';
import path from 'path';

if ( process.argv.length < 3 ) {
	console.error( 'Please provide a new name for the plugin.' );
	process.exit( 1 );
}

if ( process.argv.includes( '--help' ) || process.argv.includes( '-h' ) ) {
	console.log( `
Usage: node .bin/rename.js [options] <new-name>
Options:
    --explain   Only list changes that would be made to each file and then exit.
	--verbose   List files that are being changed as they are changed.
    --help, -h  Display this help message and exit.
` );
	process.exit( 0 );
}

const defaultName = new PluginName();
const newName = new PluginName( process.argv[ process.argv.length - 1 ] );
const explain = process.argv.includes( '--explain' );
const verbose = process.argv.includes( '--verbose' );

const currentFileDirectory = path.dirname(
	import.meta.url.replace( 'file://', '' )
);
const rootDirectory = path.resolve( currentFileDirectory, '..' );
const filesToCheck = [
	'.bin/install-wsl-no-admin.sh',
	'.config/phpcs.xml.dist',
	'.wp-env/database.php',
	'.wp-env/database.sql',
	'assets/',
	'common/',
	'config/',
	'includes/',
	'src/',
	'test/',
	'.wp-env.json',
	'composer.json',
	'composer.lock',
	'package.json',
	'package-lock.json',
	'wordpress-plugin-name.php',
];

for ( let i = 0; i < filesToCheck.length; i++ ) {
	renameWithin( filesToCheck[ i ], defaultName, newName );
}

/**
 * Replace instances of a plugin's various namespaces within the given file or directory recursively.
 * @param {string} fileOrDirectory - Relative path to a file or directory.
 * @param {PluginName} oldPluginName - The plugin's current name.
 * @param {PluginName} newPluginName - The plugin's new name.
 * @returns {void}
 */
function renameWithin( fileOrDirectory, oldPluginName, newPluginName ) {
	const filePath = path.resolve( rootDirectory, fileOrDirectory );
	if ( ! fs.existsSync( filePath ) ) {
		return;
	}
	if ( fs.lstatSync( filePath ).isDirectory() ) {
		const files = fs.readdirSync( filePath );
		for ( let i = 0; i < files.length; i++ ) {
			const file = files[ i ];
			renameWithin(
				path.join( fileOrDirectory, file ),
				oldPluginName,
				newPluginName
			);
		}
		return;
	}
	let fileContents = fs.readFileSync( filePath, 'utf8' );
	let loggedFile = false;

	if ( explain || verbose ) {
		const changes = [];
		for ( const key in oldPluginName ) {
			const oldValue = oldPluginName[ key ];
			const newValue = newPluginName[ key ];
			if ( 0 > fileContents.indexOf( oldValue ) ) {
				continue;
			}
			if ( ! loggedFile ) {
				console.log( filePath );
				loggedFile = true;
			}
			console.log( `  ${ oldValue } => ${ newValue }` );
		}
	}
	if ( explain ) {
		return;
	}

	for ( const key in oldPluginName ) {
		const oldValue = oldPluginName[ key ];
		const newValue = newPluginName[ key ];
		if ( 0 > fileContents.indexOf( oldValue ) ) {
			continue;
		}
		fileContents = fileContents.replaceAll( oldValue, newValue );
		fs.writeFileSync( filePath, fileContents, 'utf8' );
	}
}

/**
 * Declare the naming conventions for a WordPress plugin.
 * @class
 * @param {string} [name="WordPress Plugin Name"] - Plugin name shown to users in the dashboard.
 * @property {string} name - Plugin name shown to users in the dashboard.
 * @property {string} slug - Slug name of the plugin. Used in the plugin's directory name, root PHP file name, textdomain, repository name, and more. Must be lowercase with hyphens instead of spaces and all other special characters removed.
 * @property {string} prefix - Database and global function name prefix used in all PHP files declared by the plugin. Must be lowercase with underscores instead of spaces and hyphens. Here we assume that the plugin's prefix will be the same as its lowercase name with underscores instead of spaces and hyphens and no other special characters.
 * @property {string} namespace - PHP class namespace used in all PHP classes declared by the plugin. Replace spaces with underscores and remove all other special characters.
 * @property {string} constant - Constant name prefix used in all global PHP constants declared by the plugin. Must be uppercase with underscores instead of spaces. Here we assume that the plugin's constant prefix will be the same as its prefix in uppercase.
 * @property {string} textdomain - Name of the plugin's textdomain. Used to provide text translations in the dashboard and website. Must be lowercase with hyphens instead of spaces, and here we assume that the plugin's textdomain will be the same as its slug plus "-textdomain".
 * @property {string} directoryName - Name of the plugin's root directory. Must be equal to the plugin slug.
 * @property {string} rootPluginFileName - Name of the plugin's root PHP file. Must be the file which contains the plugin's registration metadata.
 */
function PluginName( name ) {
	this.name = name;
	this.slug = name
		.toLowerCase()
		.replace( /[^a-z0-9\s]/g, '' )
		.replace( /\s+/g, '-' );
	this.prefix = this.slug.replace( /-/g, '_' );
	this.namespace = name
		.replace( /\s+/g, '_' )
		.replace( /-/g, '_' )
		.replace( /[^a-z0-9_]/gi, '' );
	this.constant = this.prefix.toUpperCase();
	this.textdomain = this.slug + '-textdomain';
	this.directoryName = this.slug;
	this.rootPluginFileName = this.slug + '.php';
}
PluginName.prototype = {
	name: 'WordPress Plugin Name',
	slug: 'wordpress-plugin-name',
	prefix: 'wordpress_plugin_name',
	namespace: 'WordPress_Plugin_Name',
	constant: 'WORDPRESS_PLUGIN_NAME',
	textdomain: 'wordpress-plugin-textdomain',
	directoryName: 'wordpress-plugin-name',
	rootPluginFileName: 'wordpress-plugin-name.php',
};
