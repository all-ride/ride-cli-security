<?php

namespace pallo\cli\command\security;

/**
 * Command to search for a secured path
 */
class PathSearchCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('path', 'Shows an overview of the secured paths.');

        $this->addArgument('query', 'Query to search the paths', false, true);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $securityModel = $this->securityManager->getSecurityModel();

        $paths = $securityModel->getSecuredPaths();
        $roles = $securityModel->findRolesByName(null);

        $query = $this->input->getArgument('query');
        if ($query) {
            foreach ($paths as $index => $path) {
                if (strpos($path, $query) !== false) {
                    continue;
                }

                unset($paths[$index]);
            }
        }

        if ($paths) {
            $this->output->writeLine('Secured paths:');
            foreach ($paths as $path) {
                $this->output->writeLine($path);
            }
        }

        foreach ($roles as $role) {
            $paths = $role->getRolePaths();

            if ($query) {
                foreach ($paths as $index => $path) {
                    if (strpos($path, $query) !== false) {
                        continue;
                    }

                    unset($paths[$index]);
                }
            }

            if (!$paths) {
                continue;
            }

            $this->output->writeLine('');
            $this->output->writeLine($role->getRoleName() . ':');
            foreach ($paths as $path) {
                $this->output->writeLine($path);
            }
        }
    }

}