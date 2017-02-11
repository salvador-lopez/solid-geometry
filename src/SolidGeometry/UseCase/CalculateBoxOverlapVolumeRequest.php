<?php

namespace SolidGeometry\UseCase;

class CalculateBoxOverlapVolumeRequest
{
    private $firstBoxParams;

    private $secondBoxParams;

    public function __construct(array $firstBoxParams, array $secondBoxParams)
    {
        $this->firstBoxParams = $firstBoxParams;
        $this->secondBoxParams = $secondBoxParams;
    }

    public function getFirstBoxParams() : array
    {
        return $this->firstBoxParams;
    }

    public function getSecondBoxParams() : array
    {
        return $this->secondBoxParams;
    }


}
