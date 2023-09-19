/**
 * Add JavaScript functionality to the Shortcode output.
 * We contain the scope to prevent other page scripts from accessing it.
 *
 * @author Zachary K. Watkins <zwatkins.it@gmail.com>
 */
( function () {
	let countValue = 0;
	const counter = document.createElement( 'span' );
	const button = document.createElement( 'button' );
	button.addEventListener( 'click', function () {
		countValue += 1;
		counter.innerHTML = countValue;
	} );

	const container = document.getElementById( 'my-shortcode' );
	container.innerHTML +=
		' Your shortcode is loaded. Click the button to increase the counter.';
	container.appendChild( button );
	container.appendChild( counter );
} )();
