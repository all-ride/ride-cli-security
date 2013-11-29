<?php

namespace pallo\cli\command\security;

use pallo\library\security\exception\SecurityException;

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

        $this->addArgument('username', 'Username to identify the user');
        $this->addArgument('key', 'Key of the preference');
        $this->addArgument('value', 'Value for the preference, omit to clear the preference', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $username = $this->input->getArgument('username');
        $key = $this->input->getArgument('key');
        $value = $this->input->getArgument('value');

        $model = $this->securityManager->getSecurityModel();

        $user = $model->getUserByUsername($username);
        if (!$user) {
            throw new SecurityException('User ' . $username . ' not found.');
        }

        $user->setPreference($key, $value);

        $model->saveUser($user);
    }

}