<?php

namespace pallo\cli\command\security;

use pallo\library\security\exception\SecurityException;

/**
 * Command to search for a user
 */
class UserSearchCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new user search command
     * @return null
     */
    public function __construct() {
        parent::__construct('user', 'Shows an overview of the users.');

        $this->addArgument('query', 'Query to search the users', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $model = $this->securityManager->getSecurityModel();

        $query = $this->input->getArgument('query');
        $users = $model->findUsersByUsername($query);

        foreach ($users as $user) {
            $this->output->writeLine($user);
        }
    }

}