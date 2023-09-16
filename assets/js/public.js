/**
 * This file is added to all public pages.
 */

( function () {
	// Now your JavaScript is protected from the global runtime scope.
	const element = document.createElement( 'p' );
	element.style.textAlign = 'center';
	element.style.fontSize = '16px';
	element.innerHTML =
		'wordpress-plugin-name/js/public.js, line 10: Your plugin is loaded!';
	if ( document.body.firstChild ) {
		document.body.insertBefore( element, document.body.firstChild );
	} else {
		document.body.appendChild( element );
	}
	// eslint-disable-next-line no-console
	console.log(
		'wordpress-plugin-name/js/public.js, line 6: Your plugin is loaded!'
	);
} )();
