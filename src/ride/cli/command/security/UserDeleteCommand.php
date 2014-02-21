<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to delete a user
 */
class UserDeleteCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('user delete', 'Deletes a user from the security model.');

        $this->addArgument('username', 'Username to identify the user');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $username = $this->input->getArgument('username');

        $model = $this->securityManager->getSecurityModel();

        $user = $model->getUserByUsername($username);
        if (!$user) {
            throw new SecurityException('User ' . $username . ' not found.');
        }

        $model->deleteUser($user);
    }

}