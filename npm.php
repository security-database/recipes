<?php
/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer;

set('bin/npm', function () {
    return (string)run('which npm');
});

desc('Install npm packages');
task('npm:install', function () {
    $releases = get('releases_list');

    if (isset($releases[1])) {
        if (run("if [ -d {{deploy_path}}/releases/{$releases[1]}/node_modules ]; then echo 'true'; fi")->toBool()) {
            run("cp --recursive {{deploy_path}}/releases/{$releases[1]}/node_modules {{release_path}}");
        }
    }
    run("cd {{release_path}} && {{bin/npm}} install");
});
