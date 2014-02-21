<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to allow a secured path to a role
 */
class RoleAllowCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role allow', 'Adds a path to the allowed paths of a role.');

        $this->addArgument('name', 'Name of the role');
        $this->addArgument('path', 'Path regular expression');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $name = $this->input->getArgument('name');
        $path = $this->input->getArgument('path');

        $securityModel = $this->securityManager->getSecurityModel();

        $role = $securityModel->getRoleByName($name);
        if (!$role) {
            throw new SecurityException('Could not find role ' . $name);
        }

        $paths = $role->getPaths();
        foreach ($paths as $rolePath) {
            if ($path == $rolePath) {
                return;
            }
        }

        $paths[] = $path;

        $securityModel->setAllowedPathsToRole($role, $paths);
    }

}