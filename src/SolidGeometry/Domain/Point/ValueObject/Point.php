<?php

namespace SolidGeometry\Domain\Point\ValueObject;

use SolidGeometry\Domain\Vector\ValueObject\Vector;

class Point
{
    private $x;

    private $y;

    private $z;

    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function getX() : int
    {
        return $this->x;
    }

    public function getY() : int
    {
        return $this->y;
    }

    public function getZ() : int
    {
        return $this->z;
    }

    public function addVector(Vector $vector) : Point
    {
        $x = $this->getX() + $vector->getX();
        $y = $this->getY() + $vector->getY();
        $z = $this->getZ() + $vector->getZ();

        return new self($x, $y, $z);
    }
}
