<?php

namespace App;

class Range
{
    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Determines of two ranges overlap.
     *
     * @return true/false
     */
    public function overlaps($other)
    {
        // Check min/max of both and see if size of both fit
        // |--- 10-20 ---|
        //          |--- 15-25 ---|
        // |======================|
        // | 10   . . . . . . . 25|    min and max of both
        // (25 - 10) <= (20 - 10) + (25 - 15) ?
        //      (15) <= (10) + (10) ?
        //
        // |--- 10-20 ---|
        //                |-21-25-|
        // |======================|
        // | 10   . . . . . . . 25|    min and max of both
        // (25 - 10) <= (20 - 10) + (25 - 21) ?
        //      (15) <= (10) + (4) ?

        // get min and max
        $min = $this->min($other);
        $max = $this->max($other);

        return ($max - $min) <= $this->size() + $other->size();
    }

    /**
     * Return the smaller of two start ranges
     */
    private function min($other)
    {
        return $this->start < $other->start ? $this->start : $other->start;
    }

    /**
     * Return the larger of two end ranges
     */
    private function max($other)
    {
        return $this->end > $other->end ? $this->end : $other->end;
    }

    /**
     * Return the size of a range
     */
    private function size()
    {
        return $this->end - $this->start;
    }
}
