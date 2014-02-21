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

        $this->addArgument('name', 'Name of the role');
        $this->addArgument('permission', 'Code of the permission');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $name = $this->input->getArgument('name');
        $permission = $this->input->getArgument('permission');

        $securityModel = $this->securityManager->getSecurityModel();

        $role = $securityModel->getRoleByName($name);
        if (!$role) {
            throw new SecurityException('Could not find role ' . $name);
        }

        if (!$securityModel->hasPermission($permission)) {
            $securityModel->registerPermission($permission);
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