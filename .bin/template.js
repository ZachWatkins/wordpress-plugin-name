/**
 * Command line application to initialize this template repository.
 * @author Zachary K. Watkins <zwatkins.it@gmail.com>
 * @copyright 2023 Zachary K. Watkins
 */

import fs from 'fs';
import path from 'path';
import readline from 'readline';

const HELP = `A command line application for updating this template repository's files with unique details.
Usage: node .bin/init.js [options]
Options:
	--verbose   Log changes as they happen.
    --help, -h  Display this help message and exit.
`;

if ( process.argv.includes( '--help' ) || process.argv.includes( '-h' ) ) {
	console.log( HELP );
	process.exit( 0 );
}

const ARGS = {
	VERBOSE: process.argv.includes( '--verbose' ),
	CURRENT_PLUGIN_NAME: new PluginName(),
	CURRENT_PLUGIN_DESCRIPTION: 'A template WordPress plugin.',
	CURRENT_PLUGIN_REPOSITORY:
		'https://github.com/zachwatkins/wordpress-plugin-template',
	CURRENT_PLUGIN_COPYRIGHT: 'Zachary K. Watkins 2023',
	NEW_PLUGIN_NAME: null,
	NEW_PLUGIN_DESCRIPTION: null,
	NEW_PLUGIN_REPOSITORY: null,
	NEW_PLUGIN_COPYRIGHT: 'Zachary K. Watkins ' + new Date().getFullYear(),
	FILES: [
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
	],
	DIRNAME: path.dirname( import.meta.url.replace( 'file://', '' ) ),
	ROOT: path.resolve(
		path.dirname( import.meta.url.replace( 'file://', '' ) ),
		'..'
	),
};

const rl = readline.createInterface( {
	input: process.stdin,
	output: process.stdout,
} );

rl.question( "What is your plugin's name? ", ( answer ) => {
	ARGS.NEW_PLUGIN_NAME = new PluginName( answer );
	rl.question( "What is your plugin's description? ", ( answer ) => {
		ARGS.NEW_PLUGIN_DESCRIPTION = answer;
		rl.question(
			"What is your plugin's repository URL? https://github.com/zachwatkins/",
			( answer ) => {
				ARGS.NEW_PLUGIN_REPOSITORY = `https://github.com/zachwatkins/${ answer }`;
				rl.write( 'The following changes will be made:\n' );
				rl.write( getChangeExplanation( ARGS ) );
				rl.question( 'Proceed? [Y/n] ', ( answer ) => {
					if ( answer.toLowerCase() !== 'y' ) {
						rl.close();
						process.exit( 0 );
						return;
					}
					handle( ARGS );
					rl.close();
				} );
			}
		);
	} );
} );

/**
 * Get a message explaining the changes they are about to make to the template repository.
 * @param {ARGS} args
 * @returns {string} A message explaining the changes they are about to make to the template repository.
 */
function getChangeExplanation( args ) {
	let message = '';
	const comparedArgs = {};
	for ( const key in args ) {
		if ( 0 > key.indexOf( 'CURRENT_' ) && 0 > key.indexOf( 'NEW_' ) ) {
			continue;
		}
		if (
			typeof args[ key ] === 'object' &&
			args[ key ] !== null &&
			! Array.isArray( args[ key ] )
		) {
			for ( const subKey in args[ key ] ) {
				comparedArgs[ `${ key }:${ subKey }` ] = args[ key ][ subKey ];
			}
		} else {
			comparedArgs[ key ] = args[ key ];
		}
	}
	for ( const key in comparedArgs ) {
		if ( key.indexOf( 'CURRENT_' ) !== 0 ) {
			continue;
		}
		const newKey = key.replace( 'CURRENT_', 'NEW_' );
		if ( typeof comparedArgs[ newKey ] === 'undefined' ) {
			continue;
		}
		if ( comparedArgs[ key ] === comparedArgs[ newKey ] ) {
			continue;
		}
		message += `  ${ comparedArgs[ key ] } => ${ comparedArgs[ newKey ] }\n`;
	}
	return message;
}

/**
 * Replace instances of template text with the provided arguments.
 * @param {ARGS} args - Arguments provided by the user and request context.
 * @returns {void}
 */
function handle( args ) {
	const currentValues = {
		name: args.CURRENT_PLUGIN_NAME.name,
		slug: args.CURRENT_PLUGIN_NAME.slug,
		prefix: args.CURRENT_PLUGIN_NAME.prefix,
		namespace: args.CURRENT_PLUGIN_NAME.namespace,
		constant: args.CURRENT_PLUGIN_NAME.constant,
		textdomain: args.CURRENT_PLUGIN_NAME.textdomain,
		directoryName: args.CURRENT_PLUGIN_NAME.directoryName,
		rootPluginFileName: args.CURRENT_PLUGIN_NAME.rootPluginFileName,
		description: args.CURRENT_PLUGIN_DESCRIPTION,
		repository: args.CURRENT_PLUGIN_REPOSITORY,
		copyright: args.CURRENT_PLUGIN_COPYRIGHT,
	};
	const newValues = {
		name: args.NEW_PLUGIN_NAME.name,
		slug: args.NEW_PLUGIN_NAME.slug,
		prefix: args.NEW_PLUGIN_NAME.prefix,
		namespace: args.NEW_PLUGIN_NAME.namespace,
		constant: args.NEW_PLUGIN_NAME.constant,
		textdomain: args.NEW_PLUGIN_NAME.textdomain,
		directoryName: args.NEW_PLUGIN_NAME.directoryName,
		rootPluginFileName: args.NEW_PLUGIN_NAME.rootPluginFileName,
		description: args.NEW_PLUGIN_DESCRIPTION,
		repository: args.NEW_PLUGIN_REPOSITORY,
		copyright: args.NEW_PLUGIN_COPYRIGHT,
	};
	// Replace text within files.
	for ( let i = 0; i < args.FILES.length; i++ ) {
		replace(
			path.join( args.ROOT, args.FILES[ i ] ),
			currentValues,
			newValues,
			args.VERBOSE
		);
	}
	// Rename files.
	const currentFileName = path.join(
		args.ROOT,
		currentValues.rootPluginFileName
	);
	if ( fs.existsSync( currentFileName ) ) {
		fs.renameSync(
			currentFileName,
			path.join( args.ROOT, newValues.rootPluginFileName )
		);
	}
	const currentDirectoryName = path.join(
		args.ROOT,
		currentValues.directoryName
	);
	if ( fs.existsSync( currentDirectoryName ) ) {
		fs.renameSync(
			currentDirectoryName,
			path.join( args.ROOT, newValues.directoryName )
		);
	}
}

/**
 * Replace instances of text values within the given file.
 * @param {string} filename - Relative path to a file.
 * @param {object} oldValues - Object with keys and old values.
 * @param {object} newValues - Object with keys and new values.
 * @param {boolean} verbose - Whether to log changes as they happen.
 * @returns {void}
 */
function replaceInFile( filename, oldValues, newValues, verbose ) {
	if ( ! fs.existsSync( filename ) ) {
		return;
	}

	let content = fs.readFileSync( filename, 'utf8' );
	let contentChanged = false;
	let loggedFile = false;
	for ( const key in oldValues ) {
		const oldValue = oldValues[ key ];
		const newValue = newValues[ key ];
		if ( 0 > content.indexOf( oldValue ) ) {
			continue;
		}
		if ( verbose ) {
			if ( ! loggedFile ) {
				console.log( filename );
				loggedFile = true;
			}
			console.log( `  ${ oldValue } => ${ newValue }` );
		}
		content = content.replaceAll( oldValue, newValue );
		contentChanged = true;
	}
	if ( contentChanged ) {
		fs.writeFileSync( filename, content, 'utf8' );
	}
}

/**
 * Replace instances of a plugin's various namespaces within the given file or directory recursively.
 * @param {string} fileOrDirectory - Absolute path to a file or directory.
 * @param {object} oldValues - The current text types and values.
 * @param {object} newValues - The new text types and values.
 * @param {boolean} verbose - Whether to log changes as they happen.
 * @returns {void}
 */
function replace( fileOrDirectory, oldValues, newValues, verbose ) {
	if ( ! fs.existsSync( fileOrDirectory ) ) {
		return;
	}

	if ( fs.lstatSync( fileOrDirectory ).isDirectory() ) {
		const files = fs.readdirSync( fileOrDirectory );
		for ( let i = 0; i < files.length; i++ ) {
			const file = files[ i ];
			replace(
				path.join( fileOrDirectory, file ),
				oldValues,
				newValues,
				verbose
			);
		}
		return;
	}

	replaceInFile( fileOrDirectory, oldValues, newValues, verbose );
}

/**
 * Declare the naming conventions for a WordPress plugin.
 * @class
 * @param {string} [name="WordPress Plugin Name"] - Plugin name shown to users in the dashboard.
 * @property {string} name - Plugin name shown to users in the dashboard.
 * @property {string} slug - Slug name of the plugin. Used in the plugin's directory name, root PHP file name, textdomain, repository name, and more. Must be lowercase with hyphens instead of spaces and all other special characters and numbers removed.
 * @property {string} prefix - Database and global function name prefix used in all PHP files declared by the plugin. Must be lowercase with underscores instead of spaces and hyphens. Here we assume that the plugin's prefix will be the same as its lowercase name with underscores instead of spaces and hyphens and no other special characters or numbers.
 * @property {string} namespace - PHP class namespace used in all PHP classes declared by the plugin. Replace spaces with underscores and remove all other special characters and numbers.
 * @property {string} constant - Constant name prefix used in all global PHP constants declared by the plugin. Must be uppercase with underscores instead of spaces. Here we assume that the plugin's constant prefix will be the same as its prefix in uppercase.
 * @property {string} textdomain - Name of the plugin's textdomain. Used to provide text translations in the dashboard and website. Must be lowercase with hyphens instead of spaces, and here we assume that the plugin's textdomain will be the same as its slug plus "-textdomain".
 * @property {string} directoryName - Name of the plugin's root directory. Must be equal to the plugin slug.
 * @property {string} rootPluginFileName - Name of the plugin's root PHP file. Must be the file which contains the plugin's registration metadata.
 */
function PluginName( name ) {
	this.name = name || 'WordPress Plugin Name';
	this.slug = name
		? name
				.toLowerCase()
				.replace( /[^a-z\s]/g, '' )
				.replace( /\s+/g, '-' )
		: 'wordpress-plugin-name';
	this.prefix = name
		? this.slug.replace( /-/g, '_' )
		: 'wordpress_plugin_name';
	this.namespace = name
		? name
				.replace( /\s+/g, '_' )
				.replace( /-/g, '_' )
				.replace( /[^a-z_]/gi, '' )
		: 'WordPress_Plugin_Name';
	this.constant = name ? this.prefix.toUpperCase() : 'WORDPRESS_PLUGIN_NAME';
	this.textdomain = name
		? this.slug + '-textdomain'
		: 'wordpress-plugin-textdomain';
	this.directoryName = name ? this.slug : 'wordpress-plugin-name';
	this.rootPluginFileName = name
		? this.slug + '.php'
		: 'wordpress-plugin-name.php';
}
