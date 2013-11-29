<?php

namespace pallo\cli\command\security;

/**
 * Command to unsecure a path
 */
class PathUnsecureCommand extends AbstractSecurityCommand {

    /**
     * Constructs a path unsecure command
     * @return null
     */
    public function __construct() {
        parent::__construct('path unsecure', 'Removes a path from the secured paths.');

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

        foreach ($paths as $index => $securedPath) {
            if ($path == $securedPath) {
                unset($paths[$index]);
            }
        }

        $securityModel->setSecuredPaths($paths);
    }

}