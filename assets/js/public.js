/**
 * This file is added to all public pages.
 */

( function () {
	// Now your JavaScript is protected from the global runtime scope.
	const message =
		'Your plugin is loaded!<br>Click to dismiss.<div class="wordpress-plugin-name-file-list">Files:<ol><li>wordpress-plugin-name/assets/js/public.js</li><li>wordpress-plugin-name/assets/css/public.css</li><li>wordpress-plugin-name/src/class-init.php:39</li></ol></div>';

	// Parent element.
	const hidden = localStorage.getItem( 'wordpress-plugin-name-hidden' );
	const element = document.createElement( 'div' );
	if ( hidden ) {
		element.style.display = 'none';
		localStorage.removeItem( 'wordpress-plugin-name-hidden' );
	}
	element.id = 'wordpress-plugin-name';
	element.addEventListener( 'click', function () {
		element.style.display = 'none';
		localStorage.setItem( 'wordpress-plugin-name-hidden', true );
	} );

	// Child element.
	const content = document.createElement( 'div' );
	content.innerHTML = message;
	content.classList.add( 'wordpress-plugin-name-message' );
	content.addEventListener( 'click', function () {
		element.style.display = 'none';
	} );

	// Add elements to page.
	element.appendChild( content );
	document.body.appendChild( element );
} )();
