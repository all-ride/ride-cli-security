<?php

namespace ride\cli\command\security;

/**
 * Command to search for a role
 */
class RoleSearchCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new user search command
     * @return null
     */
    public function __construct() {
        parent::__construct('role', 'Shows an overview of the roles.');

        $this->addArgument('query', 'Query to search the roles', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $securityModel = $this->securityManager->getSecurityModel();

        $query = $this->input->getArgument('query');
        $roles = $securityModel->findRolesByName($query);

        foreach ($roles as $role) {
            $this->output->writeLine($role->getId() . ': ' . $role);
        }
    }

}