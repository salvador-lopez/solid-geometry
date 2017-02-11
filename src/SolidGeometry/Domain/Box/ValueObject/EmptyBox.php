<?php

namespace SolidGeometry\Domain\Box\ValueObject;

use SolidGeometry\Domain\Point\ValueObject\Point;
use SolidGeometry\Domain\Vector\ValueObject\Vector;

class EmptyBox extends Box
{
    public function __construct(){}

    public static function fromPointAndVector(Point $point, Vector $vector)
    {
        return new static();
    }

    public function volume() : int
    {
        return 0;
    }
}
