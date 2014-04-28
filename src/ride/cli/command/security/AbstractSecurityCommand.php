<?php

namespace ride\cli\command\security;

use ride\library\cli\command\AbstractCommand;
use ride\library\security\exception\SecurityException;
use ride\library\security\SecurityManager;

/**
 * Abstract security command
 */
abstract class AbstractSecurityCommand extends AbstractCommand {

    /**
     * Instance of the security manager
     * @var ride\library\security\SecurityManager
     */
    protected $securityManager;

    /**
     * Sets the instance of the security manager
     * @param ride\library\security\SecurityManager $securityManager
     * @return null
     */
    public function setSecurityManager(SecurityManager $securityManager) {
        $this->securityManager = $securityManager;
    }

    /**
     * Gets a user from the security model
     * @param string $id Id or name of the user
     * @return \ride\library\security\model\User
     * @throws \ride\library\security\exception\SecurityException when no user
     * found
     */
    protected function getUser($id) {
        $model = $this->securityManager->getSecurityModel();

        $user = $model->getUserById($id);
        if ($user) {
            return $user;
        }

        $user = $model->getUserByUsername($id);
        if ($user) {
            return $user;
        }

        throw new SecurityException('User ' . $id . ' not found.');
    }

    /**
     * Gets a role from the security model
     * @param string $id Id or name of the role
     * @return \ride\library\security\model\Role
     * @throws \ride\library\security\exception\SecurityException when no role
     * found
     */
    protected function getRole($id) {
        $model = $this->securityManager->getSecurityModel();

        $role = $model->getRoleById($id);
        if ($role) {
            return $role;
        }

        $role = $model->getRoleByName($id);
        if ($role) {
            return $role;
        }

        throw new SecurityException('Role ' . $id . ' not found.');
    }

}
