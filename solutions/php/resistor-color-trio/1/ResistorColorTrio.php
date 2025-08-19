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

class ResistorColorTrio
{
    private const COLOR_MAP = [
        'black'  => 0,
        'brown'  => 1,
        'red'    => 2,
        'orange' => 3,
        'yellow' => 4,
        'green'  => 5,
        'blue'   => 6,
        'violet' => 7,
        'grey'   => 8,
        'white'  => 9,
    ];

    public function label(array $colors): string
    {
        $colors = array_slice($colors, 0, 3);

        if (count($colors) < 3) {
            throw new InvalidArgumentException('Three colors required.');
        }

        foreach ($colors as $c) {
            if (!isset(self::COLOR_MAP[$c])) {
                throw new InvalidArgumentException('Unknown color: ' . $c);
            }
        }

        [$c1, $c2, $c3] = $colors;

        $main       = self::COLOR_MAP[$c1] * 10 + self::COLOR_MAP[$c2];
        $multiplier = self::COLOR_MAP[$c3];

        $ohms = (int) ($main * pow(10, $multiplier));

        if ($ohms >= 1000000000 && $ohms % 1000000000 === 0) {
            return (int) ($ohms / 1000000000) . ' gigaohms';
        }
        if ($ohms >= 1000000 && $ohms % 1000000 === 0) {
            return (int) ($ohms / 1000000) . ' megaohms';
        }
        if ($ohms >= 1000 && $ohms % 1000 === 0) {
            return (int) ($ohms / 1000) . ' kiloohms';
        }

        return $ohms . ' ohms';
    }
}
