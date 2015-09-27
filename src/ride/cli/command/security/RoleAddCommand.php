<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to add a new role
 */
class RoleAddCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Adds a new role to the security model.');

        $this->addArgument('name', 'Name to identify the role');
        $this->addArgument('weight', 'Weight of the role', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $name
     * @param string $weight
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $name, $weight = 0) {
        $securityModel = $securityManager->getSecurityModel();

        $role = $securityModel->createRole();
        $role->setName($name);
        $role->setWeight($weight);

        $securityModel->saveRole($role);
    }

}
