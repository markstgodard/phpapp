<?php

use App\Range;

class RangeTest extends \PHPUnit_Framework_TestCase
{
    public function testRangeOverlaps()
    {
        $r1 = new Range(10, 20);
        $r2 = new Range(15, 25);

        $this->assertTrue($r2->overlaps($r1));
    }


    public function testRangeDoesNotOverlap()
    {
        $r1 = new Range(10, 20);
        $r2 = new Range(21, 25);

        $this->assertFalse($r2->overlaps($r1));
    }

    public function testRangeThatIsAdjacent()
    {
        $r1 = new Range(10, 20);
        $r2 = new Range(20, 25);

        $this->assertTrue($r2->overlaps($r1));
    }

    /**
     * @dataProvider nonoverlapping
     */
    public function testRangesThatDoNotOverlap($r1, $r2)
    {
        $this->assertFalse($r2->overlaps($r1));
    }

    /**
     * @dataProvider overlapping
     */
    public function testRangesThatDoOverlap($r1, $r2)
    {
        $this->assertTrue($r2->overlaps($r1));
    }

    public function nonoverlapping()
    {
        return [
            [new Range(10, 20), new Range(21, 200)],
            [new Range(20, 21), new Range(22, 45)],
            [new Range(1, 20), new Range(100, 200)]
        ];
    }


    public function overlapping()
    {
        return [
            [new Range(10, 20), new Range(15, 20)],
            [new Range(1, 200), new Range(199, 200)],
            [new Range(1000, 2000), new Range(1500, 1501)],
        ];
    }
}
