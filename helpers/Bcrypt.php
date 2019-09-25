<?php
/**
 * Created by PhpStorm.
 * User: assis
 * Date: 24/07/18
 * Time: 22:27
 */

namespace helpers;

/**
 * Bcrypt hashing class
 *
 * @author Thiago Belem <contato@thiagobelem.net>
 * @link   https://gist.github.com/3438461
 */
class Bcrypt
{

    /**
     * Default salt prefix
     *
     * @see http://www.php.net/security/crypt_blowfish.php
     *
     * @var string
     */
    protected static $_saltPrefix = '2a';

    /**
     * Salt limit length
     *
     * @var integer
     */
    protected static $_saltLength = 22;

    /**
     * Hash a string
     *
     * @param  string $string The string
     * @param  integer $cost The hashing cost
     *
     * @see    http://www.php.net/manual/en/function.crypt.php
     *
     * @return string
     */
    public static function hash($string)
    {
       // Hash string
        $hashString = self::__generateHashString($_ENV['BCRYPT_COST'], $_ENV['BCRYPT_SALT']);

        return crypt($string, $hashString);
    }

    /**
     * Check a hashed string
     *
     * @param  string $string The string
     * @param  string $hash The hash
     *
     * @return boolean
     */
    public static function check($string, $hash)
    {
        return (crypt($string, $hash) === $hash);
    }


    /**
     * Build a hash string for crypt()
     *
     * @param  integer $cost The hashing cost
     * @param  string $salt The salt
     *
     * @return string
     */
    private static function __generateHashString($cost, $salt)
    {
        return sprintf('$%s$%02d$%s$', self::$_saltPrefix, $cost, $salt);
    }
}
