<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to unsecure a path
 */
class PathUnsecureCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Removes a path from the secured paths.');

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

        foreach ($paths as $index => $securedPath) {
            if ($path == $securedPath) {
                unset($paths[$index]);
            }
        }

        $securityModel->setSecuredPaths($paths);
    }

}