# PasswordGen

A simple class for cryptographically strong secure password generation

## Installation - Composer
This class is available as a package using composer, just run
```bash
composer require zeraphie/passwordgen
```

### Javascript
This also comes as an bower package written in javascript, compiled with gulp as it uses ES2015 for a class structure and thusly has almost exactly the same usage

To install it, run
```bash
bower install passwordgen
```
## Usage
### Setup
#### PHP
```php
// Require the autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use PasswordGen\PasswordGen;
$passwordGen = new PasswordGen();
```
#### Javascript
Simply add the [build/master.js](build/master.js) file to your build tool or add the file directly into your html and it will be ready to be used as below

### Basic
#### PHP
```php
echo $passwordGen->password();
```
#### JavaScript
```javascript
console.log(new PasswordGen().password);
```

### Changing the length
#### PHP
```php
echo $passwordGen->setLength(32)->password();
```
#### JavaScript
```javascript
console.log(new PasswordGen().setLength(32).password);
```

### Changing the keyspace
#### PHP
```php
echo $passwordGen->setKeyspace('abcdefghijklmnopqrstuvwxyz')->password();
```
#### JavaScript
```javascript
console.log(new PasswordGen().setKeyspace('abcdefghijklmnopqrstuvwxyz').password);
```

### Generating a keyspace
#### PHP
```php
echo $passwordGen->generateKeyspace('lunsw')->password();
```
#### JavaScript
```javascript
console.log(new PasswordGen().generateKeyspace('lunsw').password);
```

### Changing length and generating keyspace
#### PHP
```php
echo $passwordGen->setLength(32)->generateKeyspace('lunsw')->password();
```
#### JavaScript
```javascript
console.log(new PasswordGen().setLength(32).generateKeyspace('lunsw').password);
```
Note: The two setters are independent of each other so don't need to be in order
Note 2: Since the javascript version utilizes static getters, you can simply use (as an example to see the character sets used in the generator) `PasswordGen.CHARACTERSETS` in order to see what the properties of the class are.
You can also use `PasswordGen.arrayKeySearch(needles, haystack)` and `PasswordGen.randomInteger(min, max)`

## Character Groups
| Group               | Variable                     | Letter |
|---------------------|------------------------------|--------|
| LOWERCASELETTERS    | 'abcdefghijklmnopqrstuvwxyz' | l      |
| UPPERCASELETTERS    | 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' | u      |
| NUMBERS             | '1234567890'                 | n      |
| SPECIALCHARACTERS   | '!@#$%&*?,./\|[]{}()'        | s      |
| WHITESPACE          | ' '                          | w      |
