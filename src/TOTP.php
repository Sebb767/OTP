<?php
/**
 * Created by PhpStorm.
 * User: proj
 * Date: 8/16/16
 * Time: 12:11 AM
 */

namespace OTPLock;
use Base32\Base32;


class TOTP
{
    /**
     * @var int Length of the secret (bytes).
     */
    public static $secretLength = 16;

    /*
     * @var string The TOTP secret (base32-encoded).
     */
    protected $secret;

    /**
     * @var string The TOTP secret (in bytes).
     */
    protected $secretBytes;

    /**
     * TOTP constructor.
     * @param string $secret The base32-encoded secret
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
        $this->secretBytes = Base32::decode($secret);
    }

    /**
     * Creates a new class with a random secret
     * @return TOTP
     */
    public static function createWithRandomSecret()
    {
        $secret = Base32::encode(random_bytes(self::$secretLength));

        return new self($secret);
    }

    //
    // --- getters + setters --
    //

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
        $this->secretBytes = Base32::decode($secret);
    }

    /**
     * @return string
     */
    public function getSecretBytes()
    {
        return $this->secretBytes;
    }

    /**
     * @param string $secretBytes
     */
    public function setSecretBytes($secretBytes)
    {
        $this->secretBytes = $secretBytes;
        $this->secret = Base32::encode($secretBytes);
    }
}