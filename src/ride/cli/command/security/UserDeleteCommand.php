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

        $this->addArgument('user', 'Username or id to identify the user');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $user = $this->input->getArgument('user');
        $user = $this->getUser($user);

        $model = $this->securityManager->getSecurityModel();
        $model->deleteUser($user);
    }

}
