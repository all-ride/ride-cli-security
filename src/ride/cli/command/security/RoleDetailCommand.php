<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to detail a new role
 */
class RoleDetailCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role detail', 'Shows the details of a role.');

        $this->addArgument('role', 'Name or id of the role');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $role = $this->input->getArgument('role');
        $role = $this->getRole($role);

        $this->output->writeLine('Id: ' . $role->getId());
        $this->output->writeLine('Name: ' . $role->getName());

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
