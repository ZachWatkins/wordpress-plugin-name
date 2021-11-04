# PHP Arrays

## Indexed vs Associative Arrays

An indexed array is a typical array which is indexed numerically beginning at 0. Example:

```array( 'a', 'b', 'c' );
if ( array[0] === 'a' ) echo 'true'; // true
```

An associative array is an array that uses named keys for its key|value pairs. Example:

```array(
    'key'  => 'value',
	'key2' => 'value2',
);
if ( array['key'] === 'value' ) echo 'true'; // true
```
