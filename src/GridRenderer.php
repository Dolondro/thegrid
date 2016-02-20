<?php

namespace Dolondro\Grid;

class GridRenderer
{
    const RENDER_STRING = "render_as_string";
    const RENDER_ARRAY = "render_as_array";

    protected $validator;

    public function __construct(GridFactory $gridFactory)
    {
        $this->gridFactory = $gridFactory;
    }

    public static function create()
    {
        return new GridRenderer(new GridFactory(new Validator()));
    }

    public function render($array, $type = self::RENDER_STRING)
    {
        $grid = $this->gridFactory->create($array);
        $renderedArray = $grid->render();

        if ($type == self::RENDER_STRING) {
            return implode("\n", $renderedArray)."\n";
        } else {
            return $renderedArray;
        }
    }
}