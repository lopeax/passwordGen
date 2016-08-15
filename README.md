# PasswordGen

A simple class for cryptographically strong secure password generation

## Installation - Composer
This class is available as a package using composer, just run
```bash
composer require lopeax/passwordgen
```

## Usage
### Setup
```php
// Require the autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use PasswordGen\PasswordGen;
$passwordGen = new PasswordGen();
```
### Basic
```php
echo $passwordGen->password();
```

### Changing the length
```php
echo $passwordGen->setLength(32)->password();
```

### Changing the character groups
```php
echo $passwordGen->setKeyspace('lunsw')->password();
```

### Changing both length and character groups
```php
echo $passwordGen->setLength(32)->setKeyspace('lunsw')->password();
```
Note: The two setters are independent of each other so don't need to be in order

## Character Groups
| Group               | Variable                     | Letter |
|---------------------|------------------------------|--------|
| LOWERCASELETTERS    | 'abcdefghijklmnopqrstuvwxyz' | l      |
| UPPERCASELETTERS    | 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' | u      |
| NUMBERS             | '1234567890'                 | n      |
| SPECIALCHARACTERS   | '!@#$%&*?,./\|[]{}()'        | s      |
| WHITESPACE          | ' '                          | w      |
