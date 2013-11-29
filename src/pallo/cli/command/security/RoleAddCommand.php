<?php

namespace pallo\cli\command\security;

/**
 * Command to add a new role
 */
class RoleAddCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new role add command
     * @return null
     */
    public function __construct() {
        parent::__construct('role add', 'Adds a new role to the security model.');

        $this->addArgument('name', 'Name to identify the role');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $name = $this->input->getArgument('name');

        $securityModel = $this->securityManager->getSecurityModel();

        $role = $securityModel->createRole();
        $role->setName($name);

        $securityModel->saveRole($role);
    }

}