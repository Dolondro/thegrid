<?php


namespace Dolondro\Grid;


class Cell
{
    const COLOR_BLACK =     "\033[30m";
    const COLOR_RED =       "\033[31m";
    const COLOR_GREEN =     "\033[32m";
    const COLOR_YELLOW =    "\033[33m";
    const COLOR_BLUE =      "\033[34m";
    const COLOR_MAGENTA =   "\033[35m";
    const COLOR_CYAN =      "\033[36m";
    const COLOR_WHITE =     "\033[37m";
    const COLOR_NONE =      "\033[0m";

/*30	Black
31	Red
32	Green
33	Yellow
34	Blue
35	Magenta
36	Cyan
37	White*/


    protected $color;
    protected $value;

    public function __construct($value, $color=null)
    {
        if ($value === null) {
            $this->value = "";
        } else {
            $this->value = $value;
        }

        $this->color = ($color ? $color : self::COLOR_NONE);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getColor()
    {
        return $this->color;
    }
}