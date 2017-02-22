<?php

namespace Deployer;

task('_deploy:symlink', function () {

    run("cd {{deploy_path}} && ln -sfn {{release_path}}/{{web_path}} current");
    run("cd {{deploy_path}} && rm release");

})->desc('Creating symlink to release');
