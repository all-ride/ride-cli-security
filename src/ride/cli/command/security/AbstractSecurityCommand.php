<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\exception\SecurityException;
use ride\library\security\SecurityManager;

/**
 * Abstract security command
 */
abstract class AbstractSecurityCommand extends AbstractCommand {

    /**
     * Gets a user from the security model
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $id Id or name of the user
     * @return \ride\library\security\model\User
     * @throws \ride\library\security\exception\SecurityException when no user
     * found
     */
    protected function getUser(SecurityManager $securityManager, $id) {
        $model = $securityManager->getSecurityModel();

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
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $id Id or name of the role
     * @return \ride\library\security\model\Role
     * @throws \ride\library\security\exception\SecurityException when no role
     * found
     */
    protected function getRole(SecurityManager $securityManager, $id) {
        $model = $securityManager->getSecurityModel();

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
