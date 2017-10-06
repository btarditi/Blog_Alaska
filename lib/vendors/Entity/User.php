<?php
namespace Entity;

use \BTFram\Entity;


class User extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $salt;  // clé cryptage mdp (salage)
    protected $inscription; // date inscription
    protected $role; // role user (User ou Admin)
    
    const USERNAME_INVALIDE = 1;
    const PASSWORD_INVALIDE =2;
    const ROLE_INVALIDE = 3;
    const SALT_INVALIDE = 4;
    const EMAIL_INVALIDE = 5;
    const INSCRIPTION_INVALIDE = 6;
    
    public function isValid()
    {
        return !(empty($this->username) || empty($this->password) || empty($this->role) || empty($this->salt));
    }
    
    // GETTERS //
    public function id()
    {
        return $this->id;
    }
    public function username()
    {
        return $this->username;
    }
    public function password()
    {
        return $this->password;
    }
    public function email()
    {
        return $this->email;
    }
    public function salt()
    {
        return $this->salt;
    }
    public function role()
    {
        return $this->role;
    }
    public function inscription()
    {
        return $this->inscription;
    }
    
    // SETTERS //
    public function setId($id)
    {
        if(is_integer($id) && $id > 0)
        {
            $this->id = $id;
        }
    }
    
    public function setUsername($username)
    {
        if (!is_string($username) || empty($username) || strlen($username) > 30)
        {
            $this->erreurs[] = self::USERNAME_INVALIDE;
        }
        $this->username = $username;
    }
    
    public function setPassword($password)
    {
        if (!is_string($password) || empty($password))
        {
            $this->erreurs[] = self::PASSWORD_INVALIDE;
        }
        $this->password = $password;
    }
    
    public function setEmail($email)
    {
        if (!is_string($email) || empty($email) ) {
            $this->erreurs[] = self::EMAIL_INVALIDE;
        }
        $this->email = $email;
    }
    
    public function setSalt($salt)
    {
        if (!is_string($salt) || empty($salt))
        {
            $this->erreurs[] = self::SALT_INVALIDE;
        }
        $this->salt = $salt;
    }
    
    public function setRole($role)
    {
        if (!is_string($role) || empty($role))
        {
            $this->erreurs[] = self::ROLE_INVALIDE;
        }
        $this->role = $role;
    }
    
    public function setInscription( \DateTime $inscription)
    {
        if( !empty( $inscription ) ) {
            $this->inscription = $inscription;
        }
        else
        {
            $this->erreurs[] = self::INSCRIPTION_INVALIDE;
        }
        return $this;
    }
}