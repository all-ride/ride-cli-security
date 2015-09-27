<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to delete a user
 */
class UserDeleteCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Deletes a user from the security model.');

        $this->addArgument('user', 'Username or id to identify the user');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $user 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $user) {
        $user = $this->getUser($securityManager, $user);

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->deleteUser($user);
    }

}
