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
    --list      List changes that would be made to each file and then exit.
    --help, -h  Display this help message and exit.
` );
	process.exit( 0 );
}

const defaultName = new PluginName();
const newName = new PluginName( process.argv[ process.argv.length - 1 ] );
const listChanges = process.argv.includes( '--list' );

const currentFileDirectory = path.dirname(
	import.meta.url.replace( 'file://', '' )
);
const rootDirectory = path.resolve( currentFileDirectory, '..' );
const ignoredFiles = getIgnoredFiles();
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

/**
 * Construct a set of names used to namespace a plugin.
 * @param {string} [name="WordPress Plugin Name"] - Case sensitive plugin name with spaces.
 */
function PluginName( name ) {
	this.name = name || 'WordPress Plugin Name';
	this.slug = name.toLowerCase().replace( /\s+/g, '-' );
	this.prefix = this.slug.replace( /-/g, '_' );
	this.namespace = name.replace( /\s+/g, '_' ).replace( /-/g, '_' );
	this.constant = this.prefix.toUpperCase();
	this.textdomain =
		this.name === 'WordPress Plugin Name'
			? 'wordpress-plugin-textdomain'
			: this.slug + '-textdomain';
	this.directoryName = this.slug;
	this.rootPluginFileName = this.slug + '.php';
}

function getIgnoredFiles() {
	const ignoredFiles = [ '.git' ];
	if ( fs.existsSync( `${ rootDirectory }/.gitignore` ) ) {
		const contents = fs.readFileSync(
			`${ rootDirectory }/.gitignore`,
			'utf8'
		);
		contents.split( '\n' ).forEach( ( line ) => {
			let trimmed = line.trim();
			if (
				trimmed &&
				! line.startsWith( '#' ) &&
				! line.startsWith( '!' ) &&
				ignoredFiles.indexOf( trimmed ) === -1
			) {
				if ( trimmed.startsWith( '/' ) ) {
					trimmed = trimmed.substring( 1 );
				}
				ignoredFiles.push( trimmed );
			}
		} );
	}
	return ignoredFiles;
}
