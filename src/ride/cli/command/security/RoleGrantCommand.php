<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to grant a permission to a role
 */
class RoleGrantCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role grant', 'Grants a permission to a role.');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('permission', 'Code of the permission');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $role = $this->input->getArgument('role');
        $role = $this->getRole($role);

        $permission = $this->input->getArgument('permission');

        $securityModel = $this->securityManager->getSecurityModel();

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
