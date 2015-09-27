<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;
use ride\library\security\SecurityManager;

/**
 * Command to edit a role
 */
class RoleEditCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Sets a property of a role');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('key', 'Key of the property (name or weight)');
        $this->addArgument('value', 'Value for the property', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $role 
     * @param string $key
     * @param string $value
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $role, $key, $value = null) {
        $role = $this->getRole($securityManager, $role);

        switch ($key) {
            case 'name':
                $role->setName($value);

                break;
            case 'weight':
                $role->setWeight($value);

                break;
            default:
                throw new SecurityException('Invalid key provided: ' . $key . '. Try name or weight');
        }

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->saveRole($role);
    }

}
