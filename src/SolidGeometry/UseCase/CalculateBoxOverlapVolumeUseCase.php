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
        $firstBox = $this->buildBoxFromRequestParams($request->getFirstBoxParams());
        $secondBox = $this->buildBoxFromRequestParams($request->getSecondBoxParams());

        $overlapBox = $firstBox->overlap($secondBox);

        return $overlapBox->volume();
    }

    private function buildBoxFromRequestParams(array $boxParams): Box
    {
        $boxPointParams = $boxParams['point'];
        $boxVectorParams = $boxParams['vector'];

        return Box::fromPointAndVector(
            new Point($boxPointParams['x'], $boxPointParams['y'], $boxPointParams['z']),
            new Vector($boxVectorParams['x'], $boxVectorParams['y'], $boxVectorParams['z'])
        );
    }
}
