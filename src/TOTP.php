<?php
/**
 * Created by PhpStorm.
 * User: proj
 * Date: 8/16/16
 * Time: 12:11 AM
 */

namespace OTPLock;


class TOTP
{
    /*
     * @var string The TOTP secret.
     */
    protected $secret;

    /**
     * TOTP constructor.
     * @param string $secret create a new class instance.
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }
}