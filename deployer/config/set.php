<?php

namespace Deployer;

set('writable_use_sudo', false);

set('shared_dirs', ['{{web_path}}var', '{{web_path}}media']);

set('shared_files', ['{{web_path}}app/etc/local.xml']);

set('writable_dirs', ['{{web_path}}var', '{{web_path}}media']);

set('media',
    [
        'filter' => [
            '+ /{{web_path}}media/',
            '+ /{{web_path}}media/**',
            '- {{web_path}}*'
        ]
    ]);

set('clear_paths', [
    '.git',
    '.gitignore',
    '.gitattributes',
    '{{web_path}}composer.json',
    '{{web_path}}composer.lock',
    '{{web_path}}composer.phar',
    '{{web_path}}.env.dist',
    '{{web_path}}LICENSE.html',
    '{{web_path}}LICENSE.txt',
    '{{web_path}}LICENSE_AFL.txt',
    '{{web_path}}RELEASE_NOTES.txt',
]);

set('db_default', [
    'ignore_tables_out' => [
//        'customer_entity',
//        'customer_entity_varchar'
    ],
    'ignore_tables_in' => [],
    'post_sql_out' => '',
    'post_sql_in' => ''
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
// TODO: change to closure after fix of deployer bug
set('default_stage', (new \SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver)->getInstanceName());

set('db_instance', function () {
    return (new \SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver)->getInstanceName();
});

set('db_databases', function () {
    return [
        'database_default' => [
            get('db_defaults'),
            [
                'post_sql_in_markers' => '
                  UPDATE core_config_data set value="{{firstDomainWithSchemeAndEndingSlash}}" WHERE path="web/unsecure/base_url";
                  UPDATE core_config_data set value="{{firstDomainWithSchemeAndEndingSlash}}" WHERE path="web/secure/base_url";',
            ],
            function () {
                return (new \SourceBroker\DeployerExtendedMagento\Drivers\MagentoDriver)->getDatabaseConfig();
            },
        ]
    ];
});