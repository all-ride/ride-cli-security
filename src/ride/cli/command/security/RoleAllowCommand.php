<?php

namespace ride\cli\command\security;

use ride\library\security\SecurityManager;

/**
 * Command to allow a secured path to a role
 */
class RoleAllowCommand extends AbstractSecurityCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Adds a path to the allowed paths of a role.');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('path', 'Path regular expression');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $role 
     * @param string $path
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $role, $path) {
        $role = $this->getRole($securityManager, $role);

        $paths = $role->getPaths();
        foreach ($paths as $rolePath) {
            if ($path == $rolePath) {
                return;
            }
        }

        $paths[] = $path;

        $securityModel = $securityManager->getSecurityModel();
        $securityModel->setAllowedPathsToRole($role, $paths);
    }

}
