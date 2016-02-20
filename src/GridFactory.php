<?php


namespace Dolondro\TheGrid;


use Dolondro\TheGrid\Exception\ValidationException;

class GridFactory
{
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Arguments could be made that GridFactory is an inefficient way of doing things as it means that everytime someone
     * wants to update a grid, they're building a new instance of a grid
     *
     * To make Grid something that can be changed however feels outside of the remit of this project. The idea I'm going
     * for is to be able to easily render grids in the terminal. I don't want the concept of a Grid to be something that
     * we're actually storign data in
     *
     * @param $array
     * @throws ValidationException
     * @return Grid
     */
    public function create($array)
    {
        $this->validator->validate($array);

        // Create expects a multi-dimensional array. Each "cell" in the array should either be:
        // 1. null    (will result in nothing being rendered)
        // 2. a value (like the number 5 or what have you)
        // 3. an array like so: [$value, $colour]. Colour should be in ansi style format (like "\033[31m").
        //    a comprehensive list of them can be accessed directly from Color::COLOR_BLAH
        return new Grid($array);
    }
}