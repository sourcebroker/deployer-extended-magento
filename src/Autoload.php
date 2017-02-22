<?php

// run only if called from deployer.phar context
if (PHP_SAPI === 'cli' && function_exists('\Deployer\set')) {
    \SourceBroker\DeployerExtended\Utility\FileUtility::requireFilesFromDirectoryReqursively(__DIR__ . '/../deployer/config/');
    \SourceBroker\DeployerExtended\Utility\FileUtility::requireFilesFromDirectoryReqursively(__DIR__ . '/../deployer/task/');
}