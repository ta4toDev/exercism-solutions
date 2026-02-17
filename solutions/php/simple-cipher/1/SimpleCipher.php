<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class SimpleCipher
{
    public string $key;

    public function __construct(string $key = null)
    {
        if ($key === null) {
            $this->key = implode('', array_map(
                fn() => chr(random_int(97, 122)),
                range(1, 100)
            ));
            return;
        }
        
        if ($key === '' || !preg_match('/^[a-z]+$/', $key)) {
            throw new InvalidArgumentException('Key must be non-empty lowercase letters only.');
        }

        $this->key = $key;
    }

    public function encode(string $plainText): string
    {
        $result = '';
        for ($i = 0; $i < strlen($plainText); $i++) {
            $shift = ord($this->key[$i % strlen($this->key)]) - 97;
            $result .= chr((ord($plainText[$i]) - 97 + $shift) % 26 + 97);
        }
        return $result;
    }

    public function decode(string $cipherText): string
    {
        $result = '';
        for ($i = 0; $i < strlen($cipherText); $i++) {
            $shift = ord($this->key[$i % strlen($this->key)]) - 97;
            $result .= chr((ord($cipherText[$i]) - 97 - $shift + 26) % 26 + 97);
        }
        return $result;
    }
}