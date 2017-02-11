<?php

namespace Tests\Unit\SolidGeometry\UseCase;

use PHPUnit\Framework\TestCase;
use SolidGeometry\UseCase\CalculateBoxOverlapVolumeRequest;
use SolidGeometry\UseCase\CalculateBoxOverlapVolumeUseCase;

class CalculateBoxOverlapVolumeUseCaseTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider getDataProvider
     *
     * @param array $firstBoxParams
     * @param array $secondBoxParams
     * @param int   $expectedVolume
     */
    public function itShouldReturnExpectedVolumeForGivenRequestParams(
        array $firstBoxParams,
        array $secondBoxParams,
        int $expectedVolume
    ) {
        $useCase = new CalculateBoxOverlapVolumeUseCase();

        $request = new CalculateBoxOverlapVolumeRequest($firstBoxParams, $secondBoxParams);

        $this->assertSame($expectedVolume, $useCase->execute($request));
    }

    public function getDataProvider() : array
    {
        return [
            'Expected intersection and return volume of 8' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                ['point' => ['x' => 1, 'y' => 1, 'z' => 1], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                8,
            ],
            'Expected intersection and return volume of 0' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                ['point' => ['x' => 3, 'y' => 3, 'z' => 3], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                0,
            ],
            'Expected no intersection and return volume of 0' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                ['point' => ['x' => 4, 'y' => 3, 'z' => 3], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                0,
            ],
        ];
    }
}
