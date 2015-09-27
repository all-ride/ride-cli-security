<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to set a preference of a user
 */
class UserPreferenceCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Sets a preference of a user');

        $this->addArgument('user', 'Username or id to identify the user');
        $this->addArgument('key', 'Key of the preference');
        $this->addArgument('value', 'Value for the preference, omit to clear the preference', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $user 
     * @param string $key
     * @param string $value
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $user, $key, $value = null) {
        $user = $this->getUser($securityManager, $user);

        $user->setPreference($key, $value);

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->saveUser($user);
    }

}
