<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to grant a permission to a role
 */
class RoleGrantCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Grants a permission to a role.');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('permission', 'Code of the permission');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $role 
     * @param string $permission
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $role, $permission) {
        $role = $this->getRole($securityManager, $role);

        $securityModel = $securityManager->getSecurityModel();

        if (!$securityModel->hasPermission($permission)) {
            $securityModel->addPermission($permission);
        }

        $grantedPermissions = array(
            $permission => $permission,
        );

        $permissions = $role->getPermissions();
        foreach ($permissions as $rolePermission) {
            $grantedPermissions[$rolePermission->getCode()] = $rolePermission->getCode();
        }

        $securityModel->setGrantedPermissionsToRole($role, $grantedPermissions);
    }

}
