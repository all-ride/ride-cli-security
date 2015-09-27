<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to delete a role
 */
class RoleDeleteCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Deletes a role from the security model.');

        $this->addArgument('role', 'Name or id to identify the role');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $role 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $role) {
        $role = $this->getRole($securityManager, $role);

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->deleteRole($role);
    }

}
