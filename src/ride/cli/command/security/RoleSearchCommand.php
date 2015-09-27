<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to search for a role
 */
class RoleSearchCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Shows an overview of the roles.');

        $this->addArgument('query', 'Query to search the roles', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $query 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $query = null) {
        $securityModel = $securityManager->getSecurityModel();

        $roles = $securityModel->getRoles(array('query' => $query));

        foreach ($roles as $role) {
            $this->output->writeLine($role->getId() . ': ' . $role);
        }
    }

}
