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
     * TOTP constructor. If both parameters are given, the first one will be ignored.
     * @param string $secret The base32-encoded secret
     * @param string $binarySecret The secret as binary string.
     */
    public function __construct($secret, $binarySecret = null)
    {
        if($binarySecret !== null)
            $this->setSecretBytes($binarySecret);
        else
            $this->setSecret($secret);
    }

    /**
     * Creates a new class with a random secret
     * @return TOTP
     */
    public static function createWithRandomSecret()
    {
        $secret = random_bytes(self::$secretLength);

        return new self(null, $secret);
    }

    public function getCode()
    {

    }

    /**
     * Get QR-Code URL for image, from google charts. Taken from PHPGangsta/GoogleAuthenticator .
     *
     * @param string $name
     * @param string $title
     * @return string
     *
     * @ref https://github.com/PHPGangsta/GoogleAuthenticator/blob/master/PHPGangsta/GoogleAuthenticator.php#L69
     */
    public function getQRCodeGoogleUrl($name, $title = null) {
        $urlencoded = urlencode( 'otpauth://totp/'.$name.'?secret='.$this->secret );

        if($title !== null)
            $urlencoded .= urlencode('&issuer='.urlencode($title));

        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
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