<?php

namespace pallo\cli\command\security;

use pallo\library\security\exception\SecurityException;

/**
 * Command to detail a new user
 */
class UserDetailCommand extends AbstractSecurityCommand {

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct() {
        parent::__construct('user detail', 'Shows the details of a user.');

        $this->addArgument('username', 'Username to identify the user');
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $username = $this->input->getArgument('username');

        $model = $this->securityManager->getSecurityModel();

        $user = $model->getUserByUsername($username);
        if (!$user) {
            throw new SecurityException('User ' . $username . ' not found.');
        }

        $this->output->writeLine('Id: ' . $user->getId());
        $this->output->writeLine('Display name: ' . $user->getDisplayName());
        $this->output->writeLine('Username: ' . $user->getUserName());
        $this->output->writeLine('Email: ' . $user->getEmail());
        $this->output->writeLine('Image: ' . $user->getImage());
        $this->output->writeLine('Active: ' . ($user->isActive() ? 'yes' : 'no'));
        $this->output->writeLine('Superuser: ' . ($user->isSuperUser() ? 'yes' : 'no'));

        $preferences = $user->getPreferences();
        if ($preferences) {
            $this->output->writeLine('');
            $this->output->writeLine('Preferences:');
            foreach ($preferences as $key => $value) {
                $this->output->writeLine('- ' . $key . ': ' . $value);
            }
        }

        $roles = $user->getRoles();
        if ($roles) {
            $this->output->writeLine('');
            $this->output->writeLine('Roles:');
            foreach ($roles as $role) {
                $this->output->writeLine('- ' . $role->getName() . ' (' . $role->getId() . ')');

                $paths = $role->getPaths();
                if ($paths) {
                    $this->output->writeLine('  Allowed paths:');
                    foreach ($paths as $path) {
                        $this->output->writeLine('  - ' . $path);
                    }
                }

                $permissions = $role->getPermissions();
                if ($permissions) {
                    $this->output->writeLine('  Allowed permissions:');
                    foreach ($permissions as $permission) {
                        $this->output->writeLine('  - ' . $permission);
                    }
                }
            }
        }
    }

}