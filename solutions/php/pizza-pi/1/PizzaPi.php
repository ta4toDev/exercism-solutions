<?php

class PizzaPi
{
    public function calculateDoughRequirement(int $pizzas, int $persons)
    {
        $perPizza    = 200 + ($persons * 20);
        $totalGrams  = $pizzas * $perPizza;

        return (int) round($totalGrams);
    }

    public function calculateSauceRequirement(int $pizzas, float $canVolume)
    {
        $needed = $pizzas * 125;   
        $cans   = $needed / $canVolume;
        return (int) ceil($cans);
    }

    public function calculateCheeseCubeCoverage(float $cheeseDimension, float $thickness, float $diameter)
    {
        $volumeCube = $cheeseDimension ** 3;
        $areaPerPizza = $thickness * pi() * $diameter;
        $pizzas = $volumeCube / $areaPerPizza;
        return (int) floor($pizzas);
    }

    public function calculateLeftOverSlices(int $pizzas, int $persons)
    {
        $totalSlices    = $pizzas * 8;
        $slicesPerFriend = intdiv($totalSlices, $persons);
        $usedSlices      = $slicesPerFriend * $persons;
        return $totalSlices - $usedSlices;
    }
}
