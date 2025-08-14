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

class Tournament
{
    private array $table;

    public function __construct()
    {
        $this->table = [];
    }

    public function tally(string $scores): string
    {
        if (trim($scores) === '') {
            return $this->header();
        }
        
        foreach (explode("\n", trim($scores)) as $line) {
            [$team1, $team2, $result] = explode(';', $line);

            $this->ensureTeamExists($team1);
            $this->ensureTeamExists($team2);

            $this->table[$team1]['MP']++;
            $this->table[$team2]['MP']++;

            if ($result === 'win') {
                $this->table[$team1]['W']++;
                $this->table[$team1]['P'] += 3;
                $this->table[$team2]['L']++;
            } elseif ($result === 'loss') {
                $this->table[$team2]['W']++;
                $this->table[$team2]['P'] += 3;
                $this->table[$team1]['L']++;
            } elseif ($result === 'draw') {
                $this->table[$team1]['D']++;
                $this->table[$team2]['D']++;
                $this->table[$team1]['P']++;
                $this->table[$team2]['P']++;
            }
        }

        uksort($this->table, function ($teamA, $teamB) {
            $pointsDiff = $this->table[$teamB]['P'] <=> $this->table[$teamA]['P'];
            return $pointsDiff !== 0 ? $pointsDiff : strcmp($teamA, $teamB);
        });

        $lines = [$this->header()];
        foreach ($this->table as $team => $stats) {
            $lines[] = sprintf(
                "%-31s|  %d |  %d |  %d |  %d |  %d",
                $team,
                $stats['MP'],
                $stats['W'],
                $stats['D'],
                $stats['L'],
                $stats['P']
            );
        }

        return implode("\n", $lines);
    }

    private function header(): string
    {
        return "Team                           | MP |  W |  D |  L |  P";
    }

    private function ensureTeamExists(string $team): void
    {
        if (!isset($this->table[$team])) {
            $this->table[$team] = ['MP'=>0,'W'=>0,'D'=>0,'L'=>0,'P'=>0];
        }
    }
}

