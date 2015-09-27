<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;
use ride\library\security\SecurityManager;

/**
 * Command to edit a user
 */
class UserEditCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Sets a property of a user');

        $this->addArgument('user', 'Username or id to identify the user');
        $this->addArgument('key', 'Key of the property (name, password, email, confirm, image, active or super)');
        $this->addArgument('value', 'Value for the property', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $user 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $user, $key, $value = null) {
        $user = $this->getUser($securityManager, $user);

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
            case 'confirm':
                $user->setIsEmailConfirmed($value ? true : false);

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

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->saveUser($user);
    }

}
