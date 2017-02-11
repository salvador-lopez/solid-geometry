<?php

namespace SolidGeometry\UseCase;

use SolidGeometry\Domain\Box\ValueObject\Box;
use SolidGeometry\Domain\Point\ValueObject\Point;
use SolidGeometry\Domain\Vector\ValueObject\Vector;

class CalculateBoxOverlapVolumeUseCase
{
    /**
     * @param CalculateBoxOverlapVolumeRequest $request
     *
     * @return int
     */
    public function execute(CalculateBoxOverlapVolumeRequest $request)
    {
        $firstBoxParams = $request->getFirstBoxParams();
        $firstBoxPointParams = $firstBoxParams['point'];
        $firstBoxVectorParams = $firstBoxParams['vector'];

        $firstBox = Box::fromPointAndVector(
            new Point($firstBoxPointParams['x'], $firstBoxPointParams['y'], $firstBoxPointParams['z']),
            new Vector($firstBoxVectorParams['x'], $firstBoxVectorParams['y'], $firstBoxVectorParams['z'])
        );

        $secondBoxParams = $request->getSecondBoxParams();
        $secondBoxPointParams = $secondBoxParams['point'];
        $secondBoxVectorParams = $secondBoxParams['vector'];

        $secondBox = Box::fromPointAndVector(
            new Point($secondBoxPointParams['x'], $secondBoxPointParams['y'], $secondBoxPointParams['z']),
            new Vector($secondBoxVectorParams['x'], $secondBoxVectorParams['y'], $secondBoxVectorParams['z'])
        );

        $overlapBox = $firstBox->overlap($secondBox);

        return $overlapBox->volume();
    }
}
