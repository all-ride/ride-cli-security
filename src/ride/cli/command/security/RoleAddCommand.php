<?php

namespace ride\cli\command\security;

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
        $this->addArgument('weight', 'Weight of the role', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $name = $this->input->getArgument('name');
        $weight = $this->input->getArgument('weight', 0);

        $securityModel = $this->securityManager->getSecurityModel();

        $role = $securityModel->createRole();
        $role->setName($name);
        $role->setWeight($weight);

        $securityModel->saveRole($role);
    }

}
