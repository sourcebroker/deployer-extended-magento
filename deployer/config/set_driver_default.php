<?php

namespace Deployer;

use SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver;

add('shared_files', ['{{web_path}}app/etc/local.xml']);

set(
    'db_databases',
    [
        (new MagentoDriver)->getDatabaseConfig([
            'file' => get('current_dir') . '/app/etc/local.xml',
            'database_code' => 'database_default'
        ]),
        ['database_default' => get('db_default')],
    ]
);

set(
    'instance',
    (new MagentoDriver)->getInstanceName(['file' => get('current_dir') . '/app/etc/local.xml'])
);