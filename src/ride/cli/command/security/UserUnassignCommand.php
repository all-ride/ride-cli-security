<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

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
        if (isset($roles[$role->getId()])) {
            unset($roles[$role->getId()]);
        } else {
            throw new SecurityException('Role ' . $role->getName() . ' is not assigned to user ' . $user->getDisplayName() . '.');
        }

        $model = $this->securityManager->getSecurityModel();
        $model->setRolesToUser($user, $roles);
    }

}
