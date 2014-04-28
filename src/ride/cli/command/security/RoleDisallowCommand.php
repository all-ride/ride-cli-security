<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to disallow a secured path for a role
 */
class RoleDisallowCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('role disallow', 'Removes a path from the allowed paths of a role.');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('path', 'Path regular expression');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $role = $this->input->getArgument('role');
        $role = $this->getRole($role);

        $path = $this->input->getArgument('path');

        $securityModel = $this->securityManager->getSecurityModel();

        $paths = $role->getPaths();
        foreach ($paths as $index => $rolePath) {
            if ($path != $rolePath) {
                continue;
            }

            unset($paths[$index]);

            $securityModel->setAllowedPathsToRole($role, $paths);

            break;
        }
    }

}
