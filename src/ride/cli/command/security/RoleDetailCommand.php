<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to show the details of a role
 */
class RoleDetailCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Shows the details of a role.');

        $this->addArgument('role', 'Name or id of the role');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $role 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $role) {
        $role = $this->getRole($securityManager, $role);

        $this->output->writeLine('Id: ' . $role->getId());
        $this->output->writeLine('Name: ' . $role->getName());
        $this->output->writeLine('Weight: ' . $role->getWeight());

        $paths = $role->getPaths();
        if ($paths) {
            $this->output->writeLine('Allowed paths:');
            foreach ($paths as $path) {
                $this->output->writeLine('- ' . $path);
            }
        }

        $permissions = $role->getPermissions();
        if ($permissions) {
            $this->output->writeLine('Allowed permissions:');
            foreach ($permissions as $permission) {
                $this->output->writeLine('- ' . $permission);
            }
        }
    }

}
