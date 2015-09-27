<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;
use ride\library\security\SecurityManager;

/**
 * Command to assign a role to a user
 */
class UserUnassignCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Removes a role from a user.');

        $this->addArgument('user', 'Username or id to identify the user');
        $this->addArgument('role', 'Name or id to identify the role');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $user 
     * @param string $role 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $user, $role) {
        $user = $this->getUser($securityManager, $user);
        $role = $this->getRole($securityManager, $role);

        $roles = $user->getRoles();
        if (isset($roles[$role->getId()])) {
            unset($roles[$role->getId()]);
        } else {
            throw new SecurityException('Role ' . $role->getName() . ' is not assigned to user ' . $user->getDisplayName() . '.');
        }

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->setRolesToUser($user, $roles);
    }

}
