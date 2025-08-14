<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
         return trim($name)[0];
    }

    public function initial(string $name): string
    {
        return strtoupper($this->firstLetter($name)) . '.';
    }

    public function initials(string $name): string
    {
        $parts = explode(' ', trim($name));
        return $this->initial($parts[0]) . ' ' . $this->initial($parts[1]);
    }

   public function pair(string $sweetheart_a, string $sweetheart_b): string
{
    $initials_a = $this->initials($sweetheart_a);
    $initials_b = $this->initials($sweetheart_b);

    $heart = <<<HEART
     ******       ******
   **      **   **      **
 **         ** **         **
**            *            **
**                         **
**     {$initials_a}  +  {$initials_b}     **
 **                       **
   **                   **
     **               **
       **           **
         **       **
           **   **
             ***
              *
HEART;
    return $heart;
}

}
