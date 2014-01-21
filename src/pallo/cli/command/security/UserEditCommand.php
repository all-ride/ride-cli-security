<?php

namespace pallo\cli\command\security;

use pallo\library\security\exception\SecurityException;

/**
 * Command to edit a user
 */
class UserEditCommand extends AbstractSecurityCommand {

    /**
     * Constructs a user edit command
     * @return null
     */
    public function __construct() {
        parent::__construct('user edit', 'Sets a property of a user');

        $this->addArgument('username', 'Username to identify the user');
        $this->addArgument('key', 'Key of the property (name, password, email, image, active or super)');
        $this->addArgument('value', 'Value for the property', false);
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

        switch ($key) {
            case 'name':
                $user->setDisplayName($value);

                break;
            case 'password':
                $user->setPassword($value);

                break;
            case 'email':
                $user->setEmail($value);

                break;
            case 'image':
                $user->setImage($value);

                break;
            case 'active':
                $user->setIsActive($value ? true : false);

                break;
            case 'super':
                $user->setIsSuperUser($value ? true : false);

                break;
            default:
                throw new SecurityException('Invalid key provided: ' . $key . '. Try name, password, email, image, active or super');
        }

        $model->saveUser($user);
    }

}