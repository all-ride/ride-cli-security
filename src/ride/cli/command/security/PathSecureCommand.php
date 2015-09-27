<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to secure a path
 */
class PathSecureCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Adds a path to the secured paths.');

        $this->addArgument('path', 'Path regular expression');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $path
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $path) {
        $securityModel = $securityManager->getSecurityModel();

        $paths = $securityModel->getSecuredPaths();

        foreach ($paths as $securedPath) {
            if ($path == $securedPath) {
                return;
            }
        }

        $paths[] = $path;

        $securityModel->setSecuredPaths($paths);
    }

}