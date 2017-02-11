<?php

namespace SolidGeometry\Infrastructure\Presentation\Console;

use SolidGeometry\UseCase\CalculateBoxOverlapVolumeRequest;
use SolidGeometry\UseCase\CalculateBoxOverlapVolumeUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateBoxOverlapVolumeCommand extends Command
{
    const FIRST_BOX_ARGUMENT = 'firstBox';
    const SECOND_BOX_ARGUMENT = 'secondBox';

    protected function configure()
    {
        $this
            ->setName('calculate-box-overlap-volume')
            ->setDescription(
                'Given two combinations of initial point and distance vector, It calculates the resulting overlap volume'
            )
            ->setHelp("Example of command execution: \nWith overlap:\n".
                "bin/console.php calculate-box-overlap-volume ".
                "'{\"point\":{\"x\":0,\"y\":0,\"z\":0},\"vector\":{\"x\":3,\"y\":3,\"z\":3}}' ".
                "'{\"point\":{\"x\":1,\"y\":1,\"z\":1},\"vector\":{\"x\":3,\"y\":3,\"z\":3}}'".
                "\nWithout overlap:\n".
                "bin/console.php calculate-box-overlap-volume ".
                "'{\"point\":{\"x\":0,\"y\":0,\"z\":0},\"vector\":{\"x\":3,\"y\":3,\"z\":3}}' ".
                "'{\"point\":{\"x\":3,\"y\":3,\"z\":3},\"vector\":{\"x\":3,\"y\":3,\"z\":3}}'"
            )->addArgument(
                self::FIRST_BOX_ARGUMENT,
                InputArgument::REQUIRED,
                'A JSON representation of 3D point and 3D vector for the first box'
            )->addArgument(
                self::SECOND_BOX_ARGUMENT,
                InputArgument::REQUIRED,
                'A JSON representation of 3D point and 3D vector for the second box'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $useCase = new CalculateBoxOverlapVolumeUseCase();

        $request = new CalculateBoxOverlapVolumeRequest(
            json_decode($input->getArgument(self::FIRST_BOX_ARGUMENT), true),
            json_decode($input->getArgument(self::SECOND_BOX_ARGUMENT), true)
        );

        $output->writeln($useCase->execute($request));
    }
}
