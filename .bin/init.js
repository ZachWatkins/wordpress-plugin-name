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

if ( process.argv.length < 3 ) {
	console.error( HELP );
	process.exit( 1 );
	return;
}

if ( process.argv.includes( '--help' ) || process.argv.includes( '-h' ) ) {
	console.log( HELP );
	process.exit( 0 );
	return;
}

const ARGS = {
	VERBOSE: process.argv.includes( '--verbose' ),
	CURRENT_PLUGIN_NAME: { ...PluginName.prototype },
	CURRENT_PLUGIN_DESCRIPTION: 'A template WordPress plugin.',
	CURRENT_PLUGIN_REPOSITORY:
		'https://github.com/zachwatkins/wordpress-plugin-template',
	CURRENT_PLUGIN_AUTHOR: { ...PluginAuthor.prototype },
	CURRENT_PLUGIN_COPYRIGHT: 'Zachary K. Watkins 2023',
	NEW_PLUGIN_NAME: null,
	NEW_PLUGIN_DESCRIPTION: null,
	NEW_PLUGIN_REPOSITORY: null,
	NEW_PLUGIN_AUTHOR: new PluginAuthor(),
	NEW_PLUGIN_COPYRIGHT: new Date().getFullYear(),
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
		rl.question( "What is your plugin's repository URL? ", ( answer ) => {
			ARGS.NEW_PLUGIN_REPOSITORY = answer;
			rl.question(
				'Do you wish to change the plugin author? [Y/n] ',
				( answer ) => {
					if ( answer.toLowerCase() !== 'y' ) {
						ARGS.NEW_PLUGIN_AUTHOR = new PluginAuthor();
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
					} else {
						rl.question(
							"What is the author's name? ",
							( authorName ) => {
								rl.question(
									"What is the author's email address? ",
									( authorEmail ) => {
										rl.question(
											"What is the author's website URL? ",
											( authorUrl ) => {
												ARGS.NEW_PLUGIN_AUTHOR =
													new PluginAuthor(
														authorName,
														authorEmail,
														authorUrl
													);
												rl.write(
													'The following changes will be made:\n'
												);
												rl.write(
													getChangeExplanation( ARGS )
												);
												rl.question(
													'Proceed? [Y/n] ',
													( answer ) => {
														if (
															answer.toLowerCase() !==
															'y'
														) {
															rl.close();
															process.exit( 0 );
															return;
														}
														handle( ARGS );
														rl.close();
													}
												);
											}
										);
									}
								);
							}
						);
					}
				}
			);
		} );
	} );
} );

/**
 * Get a message explaining the changes they are about to make to the template repository.
 * @param {ARGS} args
 * @returns {string} A message explaining the changes they are about to make to the template repository.
 */
function getChangeExplanation( args ) {
	let message = '';
	for ( const key in args.CURRENT_PLUGIN_NAME ) {
		const oldValue = args.CURRENT_PLUGIN_NAME[ key ];
		const newValue = args.NEW_PLUGIN_NAME[ key ];
		if ( oldValue === newValue ) {
			continue;
		}
		message += `  ${ oldValue } => ${ newValue }\n`;
	}
	if ( args.CURRENT_PLUGIN_DESCRIPTION !== args.NEW_PLUGIN_DESCRIPTION ) {
		message += `  ${ args.CURRENT_PLUGIN_DESCRIPTION } => ${ args.NEW_PLUGIN_DESCRIPTION }\n`;
	}
	if ( args.CURRENT_PLUGIN_REPOSITORY !== args.NEW_PLUGIN_REPOSITORY ) {
		message += `  ${ args.CURRENT_PLUGIN_REPOSITORY } => ${ args.NEW_PLUGIN_REPOSITORY }\n`;
	}
	if ( args.CURRENT_PLUGIN_AUTHOR.name !== args.NEW_PLUGIN_AUTHOR.name ) {
		message += `  ${ args.CURRENT_PLUGIN_AUTHOR.name } => ${ args.NEW_PLUGIN_AUTHOR.name }\n`;
	}
	if ( args.CURRENT_PLUGIN_AUTHOR.email !== args.NEW_PLUGIN_AUTHOR.email ) {
		message += `  ${ args.CURRENT_PLUGIN_AUTHOR.email } => ${ args.NEW_PLUGIN_AUTHOR.email }\n`;
	}
	if ( args.CURRENT_PLUGIN_AUTHOR.url !== args.NEW_PLUGIN_AUTHOR.url ) {
		message += `  ${ args.CURRENT_PLUGIN_AUTHOR.url } => ${ args.NEW_PLUGIN_AUTHOR.url }\n`;
	}
	if ( args.CURRENT_PLUGIN_COPYRIGHT !== args.NEW_PLUGIN_COPYRIGHT ) {
		message += `  ${ args.CURRENT_PLUGIN_COPYRIGHT } => ${ args.NEW_PLUGIN_COPYRIGHT }\n`;
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
		authorName: args.CURRENT_PLUGIN_AUTHOR.name,
		authorEmail: args.CURRENT_PLUGIN_AUTHOR.email,
		authorUrl: args.CURRENT_PLUGIN_AUTHOR.url,
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
		authorName: args.NEW_PLUGIN_AUTHOR.name,
		authorEmail: args.NEW_PLUGIN_AUTHOR.email,
		authorUrl: args.NEW_PLUGIN_AUTHOR.url,
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
 * Declare the naming conventions for a WordPress plugin author.
 * @class
 * @param {string} [name="Zachary K. Watkins"] - Author's name.
 * @param {string} [email="zwatkins.it@gmail.com"] - Author's email address.
 * @param {string} [url="https://github.com/zachwatkins"] - Author's website URL.
 * @property {string} name - Author's name.
 * @property {string} email - Author's email address.
 * @property {string} url - Author's website URL.
 */
function PluginAuthor( name, email, url ) {
	this.name = name || this.name;
	this.email = email || this.email;
	this.url = url || this.url;
}
PluginAuthor.prototype = {
	name: 'Zachary K. Watkins',
	email: 'zwatkins.it@gmail.com',
	url: 'https://github.com/zachwatkins',
};

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
	this.name = name || this.name;
	this.slug = name
		? name
				.toLowerCase()
				.replace( /[^a-z\s]/g, '' )
				.replace( /\s+/g, '-' )
		: this.slug;
	this.prefix = this.slug.replace( /-/g, '_' );
	this.namespace = name
		.replace( /\s+/g, '_' )
		.replace( /-/g, '_' )
		.replace( /[^a-z_]/gi, '' );
	this.constant = this.prefix.toUpperCase();
	this.textdomain = name ? this.slug + '-textdomain' : this.textdomain;
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
