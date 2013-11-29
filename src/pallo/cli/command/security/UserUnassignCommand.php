<?php

namespace pallo\cli\command\security;

use pallo\library\security\exception\SecurityException;

/**
 * Command to assign a role to a user
 */
class UserUnassignCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new user assign command
     * @return null
     */
    public function __construct() {
        parent::__construct('user unassign', 'Removes a role from a user.');

        $this->addArgument('username', 'Username to identify the user');
        $this->addArgument('role', 'Name to identify the role');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $username = $this->input->getArgument('username');
        $roleName = $this->input->getArgument('role');

        $model = $this->securityManager->getSecurityModel();

        $user = $model->getUserByUsername($username);
        if (!$user) {
            throw new SecurityException('User ' . $username . ' not found.');
        }

        $role = $model->getRoleByName($roleName);
        if (!$role) {
            throw new SecurityException('Role ' . $roleName . ' not found.');
        }

        $roles = $user->getRoles();
        if (isset($roles[$role->getId()])) {
            unset($roles[$role->getId()]);
        } else {
            throw new SecurityException('Role ' . $roleName . ' is not assigned to user ' . $username . '.');
        }
    }

}