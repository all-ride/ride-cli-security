<?php

namespace pallo\cli\command\security;

use pallo\library\cli\command\AbstractCommand;
use pallo\library\security\SecurityManager;

/**
 * Abstract security command
 */
abstract class AbstractSecurityCommand extends AbstractCommand {

    /**
     * Instance of the security manager
     * @var pallo\library\security\SecurityManager
     */
    protected $securityManager;

    /**
     * Sets the instance of the security manager
     * @param pallo\library\security\SecurityManager $securityManager
     * @return null
     */
    public function setSecurityManager(SecurityManager $securityManager) {
        $this->securityManager = $securityManager;
    }

}