<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to remove a granted permission from a role
 */
class RoleDenyCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role deny', 'Removes a granted permission from a role.');

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
            return;
        }

        $grantedPermissions = array();

        $permissions = $role->getPermissions();
        foreach ($permissions as $rolePermission) {
            $grantedPermissions[$rolePermission->getCode()] = $rolePermission->getCode();
        }

        if (isset($grantedPermissions[$permission])) {
            unset($grantedPermissions[$permission]);

            $securityModel->setGrantedPermissionsToRole($role, $grantedPermissions);
        }
    }

}
