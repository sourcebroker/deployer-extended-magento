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

// Its used when you do not put any stage into task parameter.
// Thanks to that you can do: "dep db:export" and not "dep db:export local"
set('default_stage', get('instance'));