<?php


namespace Dolondro\TheGrid;


class Grid
{
    const HORIZONTAL_OUTSIDE_LINE = "\xE2\x94\x81";
    const HORIZONTAL_INNER_LINE = "\xE2\x94\x80";
    const HORIZONTAL_TOP_T_JOIN = "\xE2\x94\xAF";
    const HORIZONTAL_BOTTOM_T_JOIN = "\xE2\x94\xB7";
    const TOP_LEFT_CORNER = "\xE2\x94\x8F";
    const TOP_RIGHT_CORNER = "\xE2\x94\x93";
    const CROSS = "\xE2\x94\xBC";
    const BOTTOM_LEFT_CORNER = "\xE2\x94\x97";
    const BOTTOM_RIGHT_CORNER = "\xE2\x94\x9B";
    const VERTICAL_OUTSIDE_LINE = "\xE2\x94\x83";
    const VERTICAL_INNER_LINE = "\xE2\x94\x82";
    const VERTICAL_LEFT_T_JOIN = "\xE2\x94\xA0";
    const VERTICAL_RIGHT_T_JOIN = "\xE2\x94\xA8";

    const POSITION_TOP = "pos_top";
    const POSITION_MIDDLE = "pos_middle";
    const POSITION_BOTTOM = "pos_bottom";

    protected $cols;
    protected $rows;
    protected $grid = [];
    protected $cellWidth = 3;

    public function __construct($array)
    {
        // Maybe the validate should be here, maybe the GridFactory is misleading
        $this->rows = count($array);
        $this->cols = count($array[0]);

        // Normalise the grid!
        $this->grid = $this->normalise($array);
    }

    protected function normalise($array)
    {
        $grid = [];
        foreach ($array as $row) {
            $columns = [];
            foreach ($row as $col) {
                $color = null;
                if (is_array($col)) {
                    $value = $col[0];
                    if (isset($col[1])) {
                        $color = $col[1];
                    }
                } else {
                    $value = $col;
                }

                $this->cellWidth = max($this->cellWidth, strlen($value));

                $columns[] = new Cell($value, $color);
            }
            $grid[] = $columns;
        }
        return $grid;
    }

    public function render()
    {
        // We render as rows so the person using this library has the ability to put several grids next to each other
        // if they desire
        $renderedRows = [];
        foreach ($this->grid as $x => $row) {
            $renderedRows[] = $this->renderRow($x == 0 ? self::POSITION_TOP : self::POSITION_MIDDLE);
            $renderedRows[] = $this->renderContent($row);
        }
        $renderedRows[] = $this->renderRow(self::POSITION_BOTTOM);
        return $renderedRows;
    }

    public function renderRow($position)
    {
        $string = "";

        for ($column=0; $column < $this->cols; $column++) {
            for ($x=0; $x < $this->cellWidth + 1; $x++) {
                if ($column == 0 && $x == 0) {
                    switch ($position) {
                        case self::POSITION_TOP:
                            $string.=self::TOP_LEFT_CORNER;
                            break;

                        case self::POSITION_MIDDLE:
                            $string.=self::VERTICAL_LEFT_T_JOIN;
                            break;

                        case self::POSITION_BOTTOM:
                            $string.=self::BOTTOM_LEFT_CORNER;
                            break;
                    }
                } else if ($x == 0) {
                    switch ($position) {
                        case self::POSITION_TOP:
                            $string.=self::HORIZONTAL_TOP_T_JOIN;
                            break;

                        case self::POSITION_MIDDLE:
                            $string.=self::CROSS;
                            break;

                        case self::POSITION_BOTTOM:
                            $string.=self::HORIZONTAL_BOTTOM_T_JOIN;
                    }

                } else if ($column == $this->cols-1 && $x == $this->cellWidth) {
                    switch ($position) {
                        case self::POSITION_TOP:
                            $string .= self::HORIZONTAL_OUTSIDE_LINE . self::TOP_RIGHT_CORNER;
                            break;

                        case self::POSITION_MIDDLE:
                            $string .= self::HORIZONTAL_INNER_LINE . self::VERTICAL_RIGHT_T_JOIN;
                            break;

                        case self::POSITION_BOTTOM:
                            $string .= self::HORIZONTAL_OUTSIDE_LINE . self::BOTTOM_RIGHT_CORNER;
                    }
                } else {
                    switch($position) {
                        case self::POSITION_TOP:
                            $string .= self::HORIZONTAL_OUTSIDE_LINE;
                            break;

                        case self::POSITION_MIDDLE:
                            $string .= self::HORIZONTAL_INNER_LINE;
                            break;

                        case self::POSITION_BOTTOM:
                            $string .= self::HORIZONTAL_OUTSIDE_LINE;
                            break;
                    }
                }
            }

        }

        return $string;
    }


    /**
     * @param Cell[] $row
     * @return string
     */
    protected function renderContent($row)
    {
        $string = "";

        //var_dump($this->cellWidth);
        //die();
        foreach ($row as $column => $cell) {
            for ($x=0; $x < $this->cellWidth; $x++) {
                if ($column == 0 && $x == 0) {
                    $string .= self::VERTICAL_OUTSIDE_LINE;
                } elseif ($x == 0) {
                    $string .= self::VERTICAL_INNER_LINE;
                } elseif ($x == ($this->cellWidth-1) && $column == (count($row)-1)) {
                    $string .= self::VERTICAL_OUTSIDE_LINE;
                } elseif ($x == 1) {
                    $string .= $cell->getColor().str_pad($cell->getValue(), $this->cellWidth, " ", STR_PAD_BOTH).Cell::COLOR_NONE; // Also the colour and shit
                }
            }
            //var_dump([$cell, $column, $x, $cell->getColor().str_pad($cell->getValue(), $this->cellWidth, " ", STR_PAD_BOTH).Cell::COLOR_NONE]);

        }
        return $string;
    }
}
