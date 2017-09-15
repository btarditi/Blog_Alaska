<?php
namespace Entity;

use \BTFram\Entity;

class Users extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $salt;
    protected $role;
    
    const INVALID_USERNAME = 1;
    const INVALID_PASSWORD =2;
    const INVALID_ROLE = 3;
    const INVALID_SALT = 4;
    
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
            $this->erreurs[] = self::INVALID_USERNAME;
        }
        $this->username = $username;
    }
    
    public function setPassword($password)
    {
        if (!is_string($password) || empty($password))
        {
            $this->erreurs[] = self::INVALID_PASSWORD;
        }
        $this->password = $password;
    }
    
    public function setSalt($salt)
    {
        if (!is_string($salt) || empty($salt))
        {
            $this->erreurs[] = self::INVALID_SALT;
        }
        $this->salt = $salt;
    }
    
    public function setRole($role)
    {
        if (!is_string($role) || empty($role))
        {
            $this->erreurs[] = self::INVALID_ROLE;
        }
        $this->role = $role;
    }
}