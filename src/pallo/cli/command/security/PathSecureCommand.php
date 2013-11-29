<?php

namespace pallo\cli\command\security;

/**
 * Command to secure a path
 */
class PathSecureCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('path secure', 'Adds a path to the secured paths.');

        $this->addArgument('path', 'Path regular expression');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $path = $this->input->getArgument('path');

        $securityModel = $this->securityManager->getSecurityModel();

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