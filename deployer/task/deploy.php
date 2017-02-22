<?php

namespace Deployer;

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clean',
    'deploy:lock:overwrite_entry_point',
    'deploy:lock:create_lock_files',
    'magento:cache:clear',
    'deploy:symlink',
    'deployer:download',
    'deploy:lock:delete_lock_files',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');