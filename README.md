# PasswordGen

A simple class for password generation

## Usage
### Basic
```php
use PasswordGen\PasswordGen;

$passwordGen = new PasswordGen();
echo $passwordGen->password();
```

### Changing the length
```php
use PasswordGen\PasswordGen;

$passwordGen = new PasswordGen(32);
echo $passwordGen->password();
```

### Changing the character groups
```php
use PasswordGen\PasswordGen;

$passwordGen = new PasswordGen(16, 'lunsw');
echo $passwordGen->password();
```

## Character Groups
| Group               | Variable                     | Letter |
|---------------------|------------------------------|--------|
| LOWERCASELETTERS    | 'abcdefghijklmnopqrstuvwxyz' | l      |
| UPPERCASELETTERS    | 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' | u      |
| NUMBERS             | '1234567890'                 | n      |
| SPECIALCHARACTERS   | '!@#$%&*?,./\|[]{}()'        | s      |
| WHITESPACE          | ' '                          | w      |
