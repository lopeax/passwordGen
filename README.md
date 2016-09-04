# PasswordGen

A simple class for cryptographically strong secure password generation

## Installation - Composer
This class is available as a package using composer, just run
```bash
composer require lopeax/passwordgen
```

### Javascript
This also comes as an npm package written in javascript, compiled with gulp as it uses ES2015 for a class structure and thusly has almost exactly the same usage

To install it, run
```bash
npm install passwordgen
```
## Usage
### Setup - PHP
```php
// Require the autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use PasswordGen\PasswordGen;
$passwordGen = new PasswordGen();
```
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

## Character Groups
| Group               | Variable                     | Letter |
|---------------------|------------------------------|--------|
| LOWERCASELETTERS    | 'abcdefghijklmnopqrstuvwxyz' | l      |
| UPPERCASELETTERS    | 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' | u      |
| NUMBERS             | '1234567890'                 | n      |
| SPECIALCHARACTERS   | '!@#$%&*?,./\|[]{}()'        | s      |
| WHITESPACE          | ' '                          | w      |
