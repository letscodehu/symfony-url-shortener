<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('admin@192.168.0.40')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/var/www/html')
            ->remoteComposerBinaryPath("/usr/bin/composer")
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:letscodehu/symfony-url-shortener.git')
            // the repository branch to deploy
            ->repositoryBranch('master')
        ;
    }
    public function beforePreparing() {
        $this->runRemote('cp {{ deploy_dir }}/repo/.env.prod {{ project_dir }}/.env');
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        // $this->runRemote('{{ console_bin }} app:my-task-name');
        // $this->runLocal('say "The deployment has finished."');
    }
};
