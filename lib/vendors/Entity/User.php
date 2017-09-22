<?php
namespace Entity;

use \BTFram\Entity;

class User extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $salt;
    protected $role;
    
    const INVALIDE_USERNAME = 1;
    const INVALIDE_PASSWORD =2;
    const INVALIDE_ROLE = 3;
    const INVALIDE_SALT = 4;
    
    public function isValid()
    {
        return !(empty($this->username) || empty($this->password) || empty($this->role));
    }
    
    // GETTERS //
    public function id() {
        return $this->id;
    }
    public function username() {
        return $this->username;
    }
    public function password() {
        return $this->password;
    }
    public function salt() {
        return $this->salt;
    }
    public function role() {
        return $this->role;
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
            $this->erreurs[] = self::INVALIDE_USERNAME;
        }
        $this->username = $username;
    }
    
    public function setPassword($password)
    {
        if (!is_string($password) || empty($password))
        {
            $this->erreurs[] = self::INVALIDE_PASSWORD;
        }
        $this->password = $password;
    }
    
    public function setSalt($salt)
    {
        if (!is_string($salt) || empty($salt))
        {
            $this->erreurs[] = self::INVALIDE_SALT;
        }
        $this->salt = $salt;
    }
    
    public function setRole($role)
    {
        if (!is_string($role) || empty($role))
        {
            $this->erreurs[] = self::INVALIDE_ROLE;
        }
        $this->role = $role;
    }
}