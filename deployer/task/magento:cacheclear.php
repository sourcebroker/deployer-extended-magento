<?php

namespace Deployer;

task('magento:cache:clear', function () {

    run("cd {{release_path}} && php -r \"require_once '{{web_path}}app/Mage.php'; umask(0); Mage::app()->cleanCache();\"");

})->desc('Clear cache');
