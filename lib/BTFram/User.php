<?php
namespace BTFram;
 
session_start();

/**
 * Class User
 * @package BTFram
 */
class User
{
/**
 * Get an attribute value
 * @param  $attr
*/
    public function getAttribute($attr) // Assigner un attribut à l'utilisateur
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }
 
/**
 * Get the Flash message in array $_SESSION
 * @return mixed
*/
    public function getFlash()  //  récupérer ce message
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

/**
 * Verify if a flash message is present in $_SESSION
 * @return bool
*/    
    public function hasFlash() // Savoir si l'utilisateur a un tel message
    {
        return isset($_SESSION['flash']);
    }

/**
  * Verify if a User or Admin is logged
  * @return bool
  */    
    public function isAuthenticated() // Savoir si l'utilisateur est authentifié
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }
  
/**
 * Verify if a ADMIN is logged
 * @return bool
 */
    public function isAdmin()
    {
        if( $this->isAuthenticated() ) {
            if( isset( $_SESSION[ 'auth' ] ) && $_SESSION[ 'auth' ] === true && isset( $_SESSION[ 'role' ] ) && $_SESSION[ 'role' ] === 'ADMIN' ) {
                return true;
            } else {
                return false;
            }
        }
    }
  
/**
 * Verify if a USER is logged
 * @return bool
 */
    public function isUser()
    {
        if( isset( $_SESSION[ 'auth' ] ) && $_SESSION[ 'auth' ] === true && isset( $_SESSION[ 'role' ] ) && $_SESSION[ 'role' ] === 'USER' )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

/**
 * Add attribute to $_SESSION
 * @param $attr , $value
 * @param $value
*/
    public function setAttribute($attr, $value) // Obtenir la valeur d'un attribut
    {
        $_SESSION[$attr] = $value;
    }
/**
 * Authenticate the user
 * @param bool|Default $authenticated
*/ 
    public function setAuthenticated($authenticated = true) // Authentifier l'utilisateur
    {
        if( $authenticated == false ) {
            $_SESSION[ 'auth' ] = $authenticated;
            $_SESSION[ 'role' ] = '';
        }
        if( $authenticated == true ) {
            $_SESSION[ 'auth' ] = $authenticated;
        }
    }
 
/**
 * Add a flash message to $_SESSION
 * @param $value
*/
    public function setFlash($value) // Assigner un message informatif à l'utilisateur que l'on affichera sur la page
    {
        $_SESSION['flash'] = $value;
    }
}