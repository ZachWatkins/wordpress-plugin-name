# Constants

## Magic Constants

"There are nine magical constants that change depending on where they are used. For example, the value of `__LINE__` depends on the line that it's used on in your script. All these "magical" constants are resolved at compile time, unlike regular constants, which are resolved at runtime. These special constants are case-insensitive and are as follows:"

`__LINE__`  
The current line number of the file. [[1]](#sources-cited)

`__FILE__`  
The full path and filename of the file with symlinks resolved. If used inside an include, the name of the included file is returned. [[1]](#sources-cited)

`__DIR__`  
The directory of the file. If used inside an include, the directory of the included file is returned. This is equivalent to `dirname(__FILE__)`. This directory name does not have a trailing slash unless it is the root directory. [[1]](#sources-cited)

`__FUNCTION__`  
The function name, or {closure} for anonymous functions. [[1]](#sources-cited)

`__CLASS__`  
The class name. The class name includes the namespace it was declared in (e.g. Foo\Bar). When used in a trait method, `__CLASS__` is the name of the class the trait is used in. [[1]](#sources-cited)

`__METHOD__`  
The class method name. [[1]](#sources-cited)

`__NAMESPACE__`  
The name of the current namespace. [[1]](#sources-cited)

*`ClassName`*`::class`  
The fully qualified class name. [[1]](#sources-cited)

***

## Functions

`define(string $constant_name, mixed $value, bool $case_insensitive = false): bool`  
Defines a named constant at runtime.  
- `$constant_name`: The name of the constant.  
- `$value`: The value of the constant. In PHP 5, value must be a scalar value (int, float, string, bool, or null). In PHP 7, array values are also accepted.  
- `$case_insensitive`: If set to true, the constant will be defined case-insensitive. The default behavior is case-sensitive; i.e. CONSTANT and Constant represent different values.  

*(PHP 4, PHP 5, PHP 7, PHP 8)* [[3]](#sources-cited)

`defined(string $constant_name): bool`  
Returns true if the named constant given by `$constant_name` has been defined, false otherwise.  
*(PHP 4, PHP 5, PHP 7, PHP 8)* [[3]](#sources-cited)

Sources Cited:
1. <https://www.php.net/manual/en/language.constants.magic.php>
2. <https://www.php.net/manual/en/function.define.php>
3. <https://www.php.net/manual/en/function.defined.php>
