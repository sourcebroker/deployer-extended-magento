<?php

namespace SourceBroker\DeployerExtendedMagento;

use SourceBroker\DeployerExtended\Utility\FileUtility;

class Loader
{
    public function __construct()
    {
        require_once 'recipe/common.php';

        new \SourceBroker\DeployerExtendedDatabase\Loader();
        new \SourceBroker\DeployerExtendedMedia\Loader();
        new \SourceBroker\DeployerExtended\Loader();

        FileUtility::requireFilesFromDirectoryReqursively(
            dirname((new \ReflectionClass(\SourceBroker\DeployerExtendedMagento\Loader::class))->getFileName()) . '/../deployer/'
        );
    }
}