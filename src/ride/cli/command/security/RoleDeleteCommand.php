<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to delete a role
 */
class RoleDeleteCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role delete', 'Deletes a role from the security model.');

        $this->addArgument('name', 'Name to identify the role');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $name = $this->input->getArgument('name');

        $model = $this->securityManager->getSecurityModel();

        $role = $model->getRoleByName($name);
        if (!$role) {
            throw new SecurityException('Role ' . $name . ' not found.');
        }

        $model->deleteRole($role);
    }

}