# Assert

Static analysis safe type assertions, trough callbacks.

## Usage

The `BackEndTea\Assert\Assert` class provides four methods:

* `Assert::either(callable(mixed): TOne, callable(mixed): TTwo): callable(mixed): TOne|TTwo`
* `Assert::both(callable(mixed): TOne, callable(mixed): TTwo): callable(mixed): TOne&TTwo`
* `Assert::not(callable(mixed): T): callable(mixed): ~T`
* `Assert::all(callable(mixed): T): callable(array<mixed>): array<T>`

These methods are understood by static analysis tools capable of parsing template types (like Psalm & PHPStan).
Currently the `not` method is not understood by these tools.

Callable to use are provided by the `Type` class, for example: `Type::string()` will return a callable that validates strings.
You can create your own callbacks, and those should be understood by the tooling, as long as your annotations are correct.

Note that this library differs, in that it returns the validated value. Using this new value will make the tooling understand what it is.

```php
use BackEndTea\Assert\Assert;
use BackEndTea\Assert\Type;

/**
 * @param mixed $input
 */
function($input): ?string   
{
    $callable = Assert::either(
        Type::string(),
        Type::null()
    );
    return $callable($input);
}
```
