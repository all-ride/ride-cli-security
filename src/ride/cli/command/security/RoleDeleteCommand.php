<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to delete a role
 */
class RoleDeleteCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role delete', 'Deletes a role from the security model.');

        $this->addArgument('role', 'Name or id to identify the role');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $role = $this->input->getArgument('role');
        $role = $this->getRole($role);

        $model = $this->securityManager->getSecurityModel();
        $model->deleteRole($role);
    }

}
