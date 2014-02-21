<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to assign a role to a user
 */
class UserAssignCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new user assign command
     * @return null
     */
    public function __construct() {
        parent::__construct('user assign', 'Assigns a role to a user.');

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
        $roles[$role->getId()] = $role;

        var_export($user);
        var_export($roles);

        $model->setRolesToUser($user, $roles);
    }

}