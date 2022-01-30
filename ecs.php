<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PARALLEL, true);
    $parameters->set(Option::PATHS, [
        'src', 'tests'
    ]);
    $parameters->set(Option::SKIP, [
        'tests/Application/**'
    ]);

    $containerConfigurator->import('vendor/sylius-labs/coding-standard/ecs.php');
};
