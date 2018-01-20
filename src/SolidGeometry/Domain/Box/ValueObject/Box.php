<?php

namespace SolidGeometry\Domain\Box\ValueObject;

use SolidGeometry\Domain\Point\ValueObject\Point;
use SolidGeometry\Domain\Vector\ValueObject\Vector;

class Box
{
    /**
     * @var Point
     */
    private $minPoint;

    /**
     * @var Point
     */
    private $maxPoint;

    public static function fromPointAndVector(Point $point, Vector $vector)
    {
        $secondPoint = $point->addVector($vector);

        return new static(
            $point->getPointWithMinCoordinates($secondPoint),
            $point->getPointWithMaxCoordinates($secondPoint)
        );
    }

    private function __construct(Point $minPoint, Point $maxPoint)
    {
        $this->minPoint = $minPoint;
        $this->maxPoint = $maxPoint;
    }

    public function getMinPoint() : Point
    {
        return $this->minPoint;
    }

    public function getMaxPoint() : Point
    {
        return $this->maxPoint;
    }

    public function overlap(Box $box) : Box
    {
        if (false === $this->intersect($box)) {
            return new EmptyBox();
        }

        return new static($this->buildMinPoint($box), $this->buildMaxPoint($box));
    }

    public function volume() : int
    {
        return abs((
            ($this->maxPoint->getX() - $this->minPoint->getX()) *
            ($this->maxPoint->getY() - $this->minPoint->getY()) *
            ($this->maxPoint->getZ() - $this->minPoint->getZ())
        ));
    }

    private function intersect(Box $box) : bool
    {
        return
            (
                $this->getMinPoint()->getX() <= $box->getMaxPoint()->getX() &&
                $this->getMaxPoint()->getX() >= $box->getMinPoint()->getX()
            ) &&
            (
                $this->getMinPoint()->getY() <= $box->getMaxPoint()->getY() &&
                $this->getMaxPoint()->getY() >= $box->getMinPoint()->getY()
            ) &&
            (
                $this->getMinPoint()->getZ() <= $box->getMaxPoint()->getZ() &&
                $this->getMaxPoint()->getZ() >= $box->getMinPoint()->getZ()
            );
    }

    private function buildMinPoint(Box $box) : Point
    {
        $minPointX = max($this->getMinPoint()->getX(), $box->getMinPoint()->getX());
        $minPointY = max($this->getMinPoint()->getY(), $box->getMinPoint()->getY());
        $minPointZ = max($this->getMinPoint()->getZ(), $box->getMinPoint()->getZ());

        $minPoint = new Point($minPointX, $minPointY, $minPointZ);

        return $minPoint;
    }

    private function buildMaxPoint(Box $box) : Point
    {
        $maxPointX = min($this->getMaxPoint()->getX(), $box->getMaxPoint()->getX());
        $maxPointY = min($this->getMaxPoint()->getY(), $box->getMaxPoint()->getY());
        $maxPointZ = min($this->getMaxPoint()->getZ(), $box->getMaxPoint()->getZ());

        $maxPoint = new Point($maxPointX, $maxPointY, $maxPointZ);

        return $maxPoint;
    }
}
