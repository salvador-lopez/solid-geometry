<?php

namespace SolidGeometry\Domain\Vector\ValueObject;

class Vector
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
}
