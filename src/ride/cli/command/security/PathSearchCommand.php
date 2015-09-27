<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to search for a secured path
 */
class PathSearchCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Shows an overview of the secured paths.');

        $this->addArgument('query', 'Query to search the paths', false, true);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $query
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $query = null) {
        $securityModel = $securityManager->getSecurityModel();

        $paths = $securityModel->getSecuredPaths();
        $roles = $securityModel->getRoles(null);

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
            $paths = $role->getPaths();

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
            $this->output->writeLine($role->getName() . ':');
            foreach ($paths as $path) {
                $this->output->writeLine($path);
            }
        }
    }

}
