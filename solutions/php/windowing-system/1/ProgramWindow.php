<?php

class ProgramWindow
{
    public $x;
    public $y;
    public $height;
    public $width;

    function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->width = 800;
        $this->height = 600;
    }
      public function resize(Size $size): void
    {
        $this->height = $size->height;
        $this->width  = $size->width;
    }

    public function move(Position $position): void
    {
        $this->x = $position->x;
        $this->y = $position->y;
    }

}
