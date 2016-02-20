<?php

namespace Dolondro\TheGrid;

class GridRenderer
{
    const RENDER_STRING = "render_as_string";
    const RENDER_ARRAY = "render_as_array";

    protected $validator;

    /**
     * GridRenderer constructor.
     *
     * @param GridFactory $gridFactory
     */
    public function __construct(GridFactory $gridFactory)
    {
        $this->gridFactory = $gridFactory;
    }

    /**
     * @return GridRenderer
     */
    public static function create()
    {
        return new GridRenderer(new GridFactory(new Validator()));
    }

    /**
     * @param array $array
     * @param string $type
     * @return array|string
     */
    public function render(array $array, $type = self::RENDER_STRING)
    {
        // Create expects a multi-dimensional array. Each "cell" in the array should either be:
        // 1. null    (will result in nothing being rendered)
        // 2. a value (like the number 5 or what have you)
        // 3. an array like so: [$value, $colour]. Colour should be in ansi style format (like "\033[31m").
        //    a comprehensive list of them can be accessed directly from Color::COLOR_BLAH

        $grid = $this->gridFactory->create($array);
        $renderedArray = $grid->render();

        if ($type == self::RENDER_STRING) {
            return implode("\n", $renderedArray)."\n";
        } else {
            return $renderedArray;
        }
    }
}