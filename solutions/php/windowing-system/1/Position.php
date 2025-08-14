<?php

class Position{
    public int $x;
    public int $y;
    
 public function __construct(int $y, int $x){
     $this->y = $y;
     $this->x = $x;     
    }
}
