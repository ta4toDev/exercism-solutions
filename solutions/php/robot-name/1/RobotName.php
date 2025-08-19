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

class Robot
{
    private static array $usedNames = [];

    private ?string $name = null;
    public function getName(): string
    {
        if ($this->name === null) {
            $this->name = $this->generateUniqueName();
        }
        return $this->name;
    }

    public function reset(): void
    {
         $this->name = null;
    }

    private function generateUniqueName(): string
    {
        do {
            $candidate = $this->randomName();
        } while (isset(self::$usedNames[$candidate]));

        self::$usedNames[$candidate] = true;
        return $candidate;
    }

    private function randomName(): string
    {
        $letters = chr(random_int(65, 90)) . chr(random_int(65, 90)); // A–Z
        $digits  = str_pad((string) random_int(0, 999), 3, '0', STR_PAD_LEFT);
        return $letters . $digits;
    }
}
