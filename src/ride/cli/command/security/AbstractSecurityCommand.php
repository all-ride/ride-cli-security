<?php

namespace ride\cli\command\security;

use ride\library\cli\command\AbstractCommand;
use ride\library\security\SecurityManager;

/**
 * Abstract security command
 */
abstract class AbstractSecurityCommand extends AbstractCommand {

    /**
     * Instance of the security manager
     * @var ride\library\security\SecurityManager
     */
    protected $securityManager;

    /**
     * Sets the instance of the security manager
     * @param ride\library\security\SecurityManager $securityManager
     * @return null
     */
    public function setSecurityManager(SecurityManager $securityManager) {
        $this->securityManager = $securityManager;
    }

}