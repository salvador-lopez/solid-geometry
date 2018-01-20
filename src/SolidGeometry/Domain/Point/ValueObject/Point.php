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

    public function getPointWithMinCoordinates(Point $point)
    {
        $minPointX = $this->getMinCoordinate($this->getX(), $point->getX());
        $minPointY = $this->getMinCoordinate($this->getY(), $point->getY());
        $minPointZ = $this->getMinCoordinate($this->getZ(), $point->getZ());

        return new static($minPointX, $minPointY, $minPointZ);
    }

    public function getPointWithMaxCoordinates(Point $point)
    {
        $maxPointX = $this->getMaxCoordinate($this->getX(), $point->getX());
        $maxPointY = $this->getMaxCoordinate($this->getY(), $point->getY());
        $maxPointZ = $this->getMaxCoordinate($this->getZ(), $point->getZ());

        return new static($maxPointX, $maxPointY, $maxPointZ);
    }

    private function getMinCoordinate(int $firstCoordinate, int $secondCoordinate)
    {
        if ($firstCoordinate < $secondCoordinate) {
            return $firstCoordinate;
        }

        return $secondCoordinate;
    }

    private function getMaxCoordinate(int $firstCoordinate, int $secondCoordinate)
    {
        if ($firstCoordinate > $secondCoordinate) {
            return $firstCoordinate;
        }

        return $secondCoordinate;
    }
}
