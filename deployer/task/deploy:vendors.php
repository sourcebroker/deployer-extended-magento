<?php

namespace Deployer;

task('_deploy:vendors', function () {

    $composer = get('bin/composer');
    $envVars = get('env_vars') ? 'export ' . get('env_vars') . ' &&' : '';
    run("cd {{release_path}}/{{web_path}} && $envVars $composer {{composer_options}}");

})->desc('Installing vendors');
