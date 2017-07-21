deployer-extended-magento
=========================

.. contents:: :local:

What does it do?
----------------

This package provides deploy task for deploying Magento with deployer (deployer.org) and additionally a tasks
to synchronize database and media files.

Dependencies
------------

This package depends on following packages:

- | `sourcebroker/deployer-extended`_
  | Package which provides some deployer tasks that can be used for any framework or CMS.

- | `sourcebroker/deployer-extended-database`_
  | Package which provides some php framework independent deployer tasks to synchronize database.

- | `sourcebroker/deployer-extended-media`_
  | Package which provides some php framework independent deployer tasks to synchronize media.


Installation
------------

1) Install package with composer:
   ::

      composer require sourcebroker/deployer-extended-magento

2) If you are using deployer as composer package then just put following line in your deploy.php:
   ::

      new \SourceBroker\DeployerExtendedMagento\Loader();

3) If you are using deployer as phar then put following lines in your deploy.php:
   ::

      require __DIR__ . '/vendor/autoload.php';
      new \SourceBroker\DeployerExtendedMagento\Loader();

   | IMPORTANT NOTE!
   | Because there is inclusion of '/vendor/autoload.php' inside deployer realm then sometimes there can be conflict
     of deployer dependencies with you project dependencies. Quite often its about symfony/console version or
     monolog/monolog version because they are most common between projects. In that case use deployer installed as
     composer package and resolve the dependency problems on composer level. Example of error when you run "dep" command
     and there are dependencies problems:

     ::

      Fatal error: Declaration of Symfony\Component\Console\Input\ArrayInput::hasParameterOption() must be compatible with Symfony\Component\Console\Input\InputInterface::hasParameterOption($values, $onlyParams = false) in /.../vendor/symfony/symfony/src/Symfony/Component/Console/Input/ArrayInput.php on line 190


4) Remove task "deploy" from your deploy.php. Otherwise you will overwrite deploy task defined in
   deployer/deploy/task/deploy.php

5) Example deploy.php file for composer based deployer:
   ::

    <?php

    namespace Deployer;

    new \SourceBroker\DeployerExtendedMagento2\Loader();

    set('repository', 'git@my-git:my-project.git');

    server('live', '111.111.111.111')
        ->user('www-data')
        ->stage('live')
        ->set('public_urls', ['http://www.example.com/'])
        ->set('deploy_path', '/var/www/example.com.live');

    server('beta', '111.111.111.111')
        ->user('www-data')
        ->stage('beta')
        ->set('public_urls', ['http://beta.example.com/'])
        ->set('deploy_path', '/var/www/example.com.beta');

    server('local', 'localhost')
        ->stage('local')
        ->set('public_urls', ['http://example-com.dev/'])
        ->set('deploy_path', getcwd());


Mind the declaration of server('local', 'localhost'); Its needed for database tasks to declare domain replacements,
and path to store database dumps.


Changelog
---------

See https://github.com/sourcebroker/deployer-extended-magento/blob/master/CHANGELOG.rst


.. _sourcebroker/deployer-extended: https://github.com/sourcebroker/deployer-extended
.. _sourcebroker/deployer-extended-media: https://github.com/sourcebroker/deployer-extended-media
.. _sourcebroker/deployer-extended-database: https://github.com/sourcebroker/deployer-extended-database
