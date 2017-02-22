<?php

namespace Deployer;

set('bin/typo3cms', './vendor/bin/typo3cms');


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

set('clear_use_sudo', false);
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
    '{{web_path}}_scripts',
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

set('clear_use_sudo', false);
