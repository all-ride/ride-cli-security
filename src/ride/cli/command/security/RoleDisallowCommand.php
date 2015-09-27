<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to disallow a secured path for a role
 */
class RoleDisallowCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Removes a path from the allowed paths of a role.');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('path', 'Path regular expression');
    }

    /**
     * Invokes the command
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $role, $path) {
        $role = $this->getRole($securityManager, $role);

        $securityModel = $securityManager->getSecurityModel();

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
