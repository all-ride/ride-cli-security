<?php

namespace ride\cli\command\security;

use ride\cli\command\AbstractCommand;

use ride\library\security\SecurityManager;

/**
 * Command to search for a user
 */
class UserSearchCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Shows an overview of the users.');

        $this->addArgument('query', 'Query to search the users', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $query 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $query = null) {
        $securityModel = $securityManager->getSecurityModel();
        $users = $securityModel->getUsers(array('query' => $query));

        foreach ($users as $user) {
            $this->output->writeLine($user->getId() . ': ' . $user->getDisplayName() . ' (' . $user->getUserName() . ')');
        }
    }

}
