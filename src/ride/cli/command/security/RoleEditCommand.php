<?php

namespace ride\cli\command\security;

use ride\library\security\exception\SecurityException;

/**
 * Command to edit a role
 */
class RoleEditCommand extends AbstractSecurityCommand {

    /**
     * Constructs a role edit command
     * @return null
     */
    public function __construct() {
        parent::__construct('role edit', 'Sets a property of a role');

        $this->addArgument('role', 'Name or id of the role');
        $this->addArgument('key', 'Key of the property (name or weight)');
        $this->addArgument('value', 'Value for the property', false);
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $role = $this->input->getArgument('role');
        $role = $this->getRole($role);

        $key = $this->input->getArgument('key');
        $value = $this->input->getArgument('value');

        switch ($key) {
            case 'name':
                $role->setName($value);

                break;
            case 'weight':
                $role->setWeight($value);

                break;
            default:
                throw new SecurityException('Invalid key provided: ' . $key . '. Try name or weight');
        }

        $model = $this->securityManager->getSecurityModel();
        $model->saveRole($role);
    }

}
