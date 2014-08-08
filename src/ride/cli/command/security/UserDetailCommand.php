<?php

namespace ride\cli\command\security;

use ride\library\decorator\Decorator;
use ride\library\security\exception\SecurityException;

/**
 * Command to detail a new user
 */
class UserDetailCommand extends AbstractSecurityCommand {

    /**
     * Instance of the decorator for the preferences
     * @var \ride\library\decorator\Decorator
     */
    protected $preferenceDecorator;

    /**
     * Constructs a new translation unset command
     * @return null
     */
    public function __construct(Decorator $preferenceDecorator) {
        parent::__construct('user detail', 'Shows the details of a user.');

        $this->addArgument('user', 'Username or id to identify the user');

        $this->preferenceDecorator = $preferenceDecorator;
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $user = $this->input->getArgument('user');
        $user = $this->getUser($user);

        $email = $user->getEmail();

        $this->output->writeLine('Id: ' . $user->getId());
        $this->output->writeLine('Display name: ' . $user->getDisplayName());
        $this->output->writeLine('Username: ' . $user->getUserName());
        $this->output->writeLine('Email: ' . $email . ($email ? ' [' . ($user->isEmailConfirmed() ? 'V' : 'X') . ']' : ''));
        $this->output->writeLine('Image: ' . $user->getImage());
        $this->output->writeLine('Active: ' . ($user->isActive() ? 'yes' : 'no'));
        $this->output->writeLine('Superuser: ' . ($user->isSuperUser() ? 'yes' : 'no'));

        $preferences = $user->getPreferences();
        if ($preferences) {
            $this->output->writeLine('');
            $this->output->writeLine('Preferences:');
            foreach ($preferences as $key => $value) {
                $this->output->writeLine('- ' . $key . ': ' . $this->preferenceDecorator->decorate($value));
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
