# WordPress Library

This is a library of WordPress functions and classes that I use in my projects.

## Principles

I follow certain principles which make the functions in this library easy to understand and use:

1. All functions defined in this library do not call other functions in this library. This makes it easy to copy and paste a function into your project without having to copy and paste other functions.
2. No function defined in this library is prefixed with `wp_`. This makes it easy to distinguish between WordPress Core functions and custom functions.
3. All files are namespaced. This makes it easy to copy and paste a function into your project without changing its name.
4. All functions are documented with PHPDoc. This makes it easy to understand what a function does and how to use it.

## Essential WordPress Core functions

The following WordPress Core functions are used often in this library and are documented here to make it easier for newer WordPress developers to learn.

### `add_action( string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1 ): true`

Queue `$callback` to execute when the `$hook_name` action is fired by WordPress. Each hook name can have multiple callbacks. The `$callback` argument can be a function name, a class method, or an anonymous function. The `$priority` argument determines the order in which your callback is executed among the other callbacks registered to that hook name. The `$accepted_args` argument determines how many arguments are passed to the callback.

The return value of the `$callback` function is ignored by most action hooks, but some (especially ones like `pre_{$hook_name}`) use callback return values to halt the execution of an action or affect the process in other ways.

Link: https://developer.wordpress.org/reference/functions/add_action/

Action API Reference: https://codex.wordpress.org/Plugin_API/Action_Reference/

### `add_filter( string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1 ): true`

Queue `$callback` to execute when the `$hook_name` filter is fired by WordPress. Each hook name can have multiple callbacks. The `$callback` argument can be a function name, a class method, or an anonymous function. The `$priority` argument determines the order in which your callback is executed among the other callbacks registered to that hook name. The `$accepted_args` argument determines how many arguments are passed to the callback.

The return value of the `$callback` function is used as the new value of the filtered data.

Link: https://developer.wordpress.org/reference/functions/add_filter/

Filter API Reference: https://codex.wordpress.org/Plugin_API/Filter_Reference
