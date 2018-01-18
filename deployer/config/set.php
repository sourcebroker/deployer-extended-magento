<?php

namespace Deployer;

set('web_path', '');

set('shared_dirs', [
    '{{web_path}}var',
    '{{web_path}}media'
]);

set('writable_dirs', [
        '{{web_path}}var',
        '{{web_path}}media'
    ]
);

set('shared_files', [
    '{{web_path}}app/etc/local.xml'
]);

set('clear_paths', [
    '.git',
    '.gitignore',
    '.gitattributes',
    'composer.json',
    'composer.lock',
    'composer.phar',
    '{{web_path}}.env.dist',
    '{{web_path}}LICENSE.html',
    '{{web_path}}LICENSE.txt',
    '{{web_path}}LICENSE_AFL.txt',
    '{{web_path}}RELEASE_NOTES.txt',
]);

// Look on https://github.com/sourcebroker/deployer-extended#buffer-start for docs
set('buffer_config', [
        'index.php' => [
            'entrypoint_filename' => 'index.php',
        ],
    ]
);

// Look https://github.com/sourcebroker/deployer-extended-media for docs
set('media',
    [
        'filter' => [
            '+ /{{web_path}}',
            '+ /{{web_path}}media/',
            '+ /{{web_path}}media/**',
            '- {{web_path}}*',
            '- *'
        ]
    ]);

// Look https://github.com/sourcebroker/deployer-extended-database#db-dumpclean for docs
set('db_dumpclean_keep', [
    '*' => 5,
    'live' => 10,
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('default_stage', function () {
    return (new \SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver)->getInstanceName(get('web_path', null));
});

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_instance', function () {
    return (new \SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver)->getInstanceName(get('web_path', null));
});

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_databases', function () {
    return [
        'database_default' => [
            [
                'ignore_tables_out' => [
                    'log_.*',
                ],
                'post_sql_in_markers' => '
                  UPDATE core_config_data set value="{{firstDomainWithSchemeAndEndingSlash}}" WHERE path="web/unsecure/base_url";
                  UPDATE core_config_data set value="{{firstDomainWithSchemeAndEndingSlash}}" WHERE path="web/secure/base_url";',
            ],
            (new \SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver)->getDatabaseConfig(get('web_path', null)),
            get('db_database_default_context', [])
        ]
    ];
});