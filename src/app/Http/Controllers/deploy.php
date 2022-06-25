<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/php-fpm.php';
require 'contrib/npm.php';

set('application', 'scifi_mgtos');
set('repository', 'https://github.com/mudassir1996/scifi_mgtos.git');
set('php_fpm_version', '8.0');

host('prod')
    ->set('remote_user', 'tharktmy')
    ->set('hostname', 'vzero.ros.scifitechnologies.org')
    ->set('deploy_path', 'public_html/{{hostname}}');

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'npm:install',
    'npm:run:prod',
    'deploy:publish',
    'php-fpm:reload',
]);

task('npm:run:prod', function () {
    cd('{{release_or_current_path}}');
    run('npm run prod');
});

after('deploy:failed', 'deploy:unlock');
