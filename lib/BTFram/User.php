<?php
namespace BTFram;
 
session_start();
 
class User
{
  public function getAttribute($attr) // Assigner un attribut à l'utilisateur
  {
    return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
  }
 
  public function getFlash()  //  récupérer ce message
  {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
 
    return $flash;
  }
 
  public function hasFlash() // Savoir si l'utilisateur a un tel message
  {
    return isset($_SESSION['flash']);
  }
 
  public function isAuthenticated() // Savoir si l'utilisateur est authentifié
  {
    return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
  }
  
  public function isAdmin()
  {
        if ($this->isAuthenticated())
            {
            if ($_SESSION['auth'] === true)
                {
                return true;
            }
            else
                {
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
        if ($_SESSION['auth'] === true)
            {
            return true;
        }
        else
            {
            return false;
        }
    }
    
  public function setAttribute($attr, $value) // Obtenir la valeur d'un attribut
  {
    $_SESSION[$attr] = $value;
  }
 
  public function setAuthenticated($authenticated = true) // Authentifier l'utilisateur
  {
    if (!is_bool($authenticated))
    {
      throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
    }
 
    $_SESSION['auth'] = $authenticated;
  }
 
  public function setFlash($value) // Assigner un message informatif à l'utilisateur que l'on affichera sur la page
  {
    $_SESSION['flash'] = $value;
  }
}