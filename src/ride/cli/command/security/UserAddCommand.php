<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to add a new user
 */
class UserAddCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Adds a new user to the security model.');

        $this->addArgument('username', 'Username to identify the user');
        $this->addArgument('password', 'Password to authenticate the user');
        $this->addArgument('email', 'Email address of the user', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $username
     * @param string $password
     * @param string $email 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $username, $password, $email) {
        $securityModel = $securityManager->getSecurityModel();

        $user = $securityModel->createUser();
        $user->setUserName($username);
        $user->setPassword($password);
        $user->setIsActive(true);
        if ($email) {
            $user->setEmail($email);
        }

        $securityModel->saveUser($user);
    }

}