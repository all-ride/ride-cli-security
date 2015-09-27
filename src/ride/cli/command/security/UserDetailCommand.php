<?php

namespace ride\cli\command\security;

use ride\library\decorator\Decorator;
use ride\library\security\SecurityManager;

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
     * Sets the preference decorator
     * @param \ride\library\decorator\Decorator $preferenceDecorator
     * @return null
     */
    public function setPreferenceDecorator(Decorator $preferenceDecorator) {
        $this->preferenceDecorator = $preferenceDecorator;
    }
    
    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {    
        $this->setDescription('Shows the details of a user.');

        $this->addArgument('user', 'Username or id to identify the user');
    }

    /**
     * Invokes the command
     * @param \ride\library\security\SecurityManager $securityManager
     * @param string $user 
     * @return null
     */
    public function invoke(SecurityManager $securityManager, $user) {
        $user = $this->getUser($securityManager, $user);

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
