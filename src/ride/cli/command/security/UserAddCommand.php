<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to add a new user
 */
class UserAddCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('user add', 'Adds a new user to the security model.');

        $this->addArgument('username', 'Username to identify the user');
        $this->addArgument('password', 'Password to authenticate the user');
        $this->addArgument('email', 'Email address of the user', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $username = $this->input->getArgument('username');
        $password = $this->input->getArgument('password');
        $email = $this->input->getArgument('email');

        $model = $this->securityManager->getSecurityModel();

        $user = $model->createUser();
        $user->setUserName($username);
        $user->setPassword($password);
        $user->setIsActive(true);
        if ($email) {
            $user->setEmail($email);
        }

        $model->saveUser($user);
    }

}