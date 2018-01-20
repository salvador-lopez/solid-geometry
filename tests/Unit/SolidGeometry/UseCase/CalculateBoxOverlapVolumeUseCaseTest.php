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
            'Test 1: Expected intersection and return volume of 8' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                ['point' => ['x' => 1, 'y' => 1, 'z' => 1], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                8,
            ],
            'Test 2: Expected intersection and return volume of 0' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                ['point' => ['x' => 3, 'y' => 3, 'z' => 3], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                0,
            ],
            'Test 3: Expected no intersection and return volume of 0' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                ['point' => ['x' => 4, 'y' => 3, 'z' => 3], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                0,
            ],
            'Test 4: Expected no intersection and return volume of 0' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => -3, 'y' => -3, 'z' => -3]],
                ['point' => ['x' => 1, 'y' => 1, 'z' => 1], 'vector' => ['x' => 3, 'y' => 3, 'z' => 3]],
                0,
            ],
            'Test 5: Expected intersection and return volume of 27' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => -4, 'y' => -4, 'z' => -4]],
                ['point' => ['x' => -1, 'y' => -1, 'z' => -1], 'vector' => ['x' => -4, 'y' => -4, 'z' => -4]],
                27,
            ],
            'Test 6: Expected intersection and return volume of 8' => [
                ['point' => ['x' => 1, 'y' => 1, 'z' => 1], 'vector' => ['x' => -4, 'y' => -4, 'z' => -4]],
                ['point' => ['x' => -1, 'y' => -1, 'z' => -1], 'vector' => ['x' => -4, 'y' => -4, 'z' => -4]],
                8,
            ],
            'Test 7: Expected intersection and return volume of 1' => [
                ['point' => ['x' => 0, 'y' => 0, 'z' => 0], 'vector' => ['x' => 2, 'y' => 2, 'z' => 2]],
                ['point' => ['x' => 2, 'y' => 0, 'z' => 0], 'vector' => ['x' => -1, 'y' => 1, 'z' => 1]],
                1,
            ],
        ];
    }
}
