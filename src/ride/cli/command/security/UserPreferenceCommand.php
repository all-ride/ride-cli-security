<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to set a preference of a user
 */
class UserPreferenceCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('user preference', 'Sets a preference of a user');

        $this->addArgument('user', 'Username or id to identify the user');
        $this->addArgument('key', 'Key of the preference');
        $this->addArgument('value', 'Value for the preference, omit to clear the preference', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $user = $this->input->getArgument('user');
        $user = $this->getUser($user);

        $key = $this->input->getArgument('key');
        $value = $this->input->getArgument('value');

        $user->setPreference($key, $value);

        $model = $this->securityManager->getSecurityModel();
        $model->saveUser($user);
    }

}
