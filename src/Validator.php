<?php


namespace Dolondro\Grid;


use Dolondro\Grid\Exception\ValidationException;

class Validator
{

    /**
     * Validate is purely checking that the data we received isn't stupid. It doesn't check the values of the
     * actual cells, as that is probably overkill
     *
     * @param $array
     * @throws ValidationException
     */
    public function validate($array)
    {
        if (!is_array($array)) {
            throw new ValidationException("Non-array passed to the GridFactory");
        }

        if (count($array)==0) {
            throw new ValidationException("Empty array passed to the GridFactory");
        }

        if ($this->isAssociativeArray($array)) {
            throw new ValidationException("Associative array passed to the GridFactory. Numeric expected");
        }

        $cols = 0;
        foreach ($array as $key => $row) {
            if (!is_array($row)) {
                throw new ValidationException("Row {$key} was not an array");
            }

            if ($this->isAssociativeArray($row)) {
                throw new ValidationException("Row {$key} passed to the  GridFactory render as an associative array. Numeric expected");
            }

            if ($key == 0) {
                $cols = count($row);
            } else {
                if (count($row) != $cols) {
                    throw new ValidationException("Row {$key} had an inconsistant number of columns [".count($row)."]. {$cols} expected");
                }
            }
        }

    }

    protected function isAssociativeArray($array)
    {
        return (array_keys($array) !== range(0, count($array) - 1));
    }
}