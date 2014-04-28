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

        $this->addArgument('user', 'Username or id to identify the user');
        $this->addArgument('role', 'Name or id to identify the role');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $user = $this->input->getArgument('user');
        $user = $this->getUser($user);

        $role = $this->input->getArgument('role');
        $role = $this->getRole($role);

        $roles = $user->getRoles();
        $roles[$role->getId()] = $role;

        $model = $this->securityManager->getSecurityModel();
        $model->setRolesToUser($user, $roles);
    }

}
