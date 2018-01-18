
Changelog
---------

5.0.0
~~~~~

a) [TASK] Introduce deployer-loader in src/Loader.php
b) [TASK] Add default value for 'web_path' and set it to empty.
c) [TASK] Remove 'web_path' from 'clear_paths' for composer.json / composer.lock
d) [TASK] [!!!BREAKING] Change the way getInstanceName parameters works. Param means now path relative to root of project.
e) [TASK] [!!!BREAKING] Change the way getDatabaseConfig parameters works. Param means now path relative to root of project.
f) [TASK] Update dependent packages. Add deployer-loader package.
g) [FEATURE] Add db:backup task to do backup of database before each deploy.
h) [TASK] Cleanup for db_default default values.

4.0.1
~~~~~

a) [TASK] Make dependency to deployer/deployer-dist

4.0.0
~~~~~

a) [TASK][BREAKING] Increase the sourcebroker/deployer-extended-database version to 4.0.0

3.0.1
~~~~~

a) Fix wrong ignore log_* tables

3.0.0
~~~~~

a) Ignore log_* tables as default on database pull/copy

2.0.0
~~~~~

a) Set "default_stage" as callable. This way "default_stage" can be now overwritten in higher level packages.
b) Increase deployer-extended-database for callable default_stage