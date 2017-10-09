<?php
namespace Model;

use \Entity\User;

/**
 * Class UserManagerPDO
 * Gestion des requetes utilisateur. 
 */
class UserManagerPDO extends UserManager
{
    /**
     * Get a user by id.
     * @param int $id
     * @return mixed
     */
    public function getUnique( $id)
    {
        $q = $this->dao->prepare('SELECT * FROM users WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $q->fetch();
    }
    /**
     * Get a user by the username
     * @param string $username
     * @return mixed
     */
    public function getByUsername( $username)
    {
        $q = $this->dao->prepare('SELECT * FROM users WHERE username = :username');
        $q->bindValue(':username', $username);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $q->fetch();
    }
    /**
     * Get all users in the DB
     * @return array
     */
    public function getAll()
    {
        $q = $this->dao->query('SELECT * FROM users ORDER BY role, username ');
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $users = $q->fetchAll();
    }
    /**
     * Count the Users
     * @return mixed
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM users ')->fetchColumn();
    }
    /**
     * Add a user un the Db
     * @param \Entity\Users $user
     */
    protected function insert( User $user)
    {
        $q = $this->dao->prepare('INSERT INTO users SET username = :username, password = :password, email = :email, salt = :salt, role = :role, inscription = NOW()');
        
        $q->bindValue(':username', $user->username());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        
        $q->execute();
    }
    /**
     * Update un users
     * @param \Entity\Users $user
     */
    protected function update( User $user)
    {
        $q = $this->dao->prepare('UPDATE users SET username = :username, password = :password, email = :email, role = :role, inscription = now()  WHERE id = :id');
        
        $q->bindValue(':id', $user->id());
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':email', $user->email());
        //$q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        //$q->bindValue(':inscription', $user->inscription());
        
        $q->execute();
    }
    /**
     * Delete user by id
     * @param int $id
     */
    public function delete( $id)
    {
        $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
    }
    
    /**
     * Return a list for all Users
     * @param int $debut
     * @param int $limite
     * @return array List Users Objects
     */
    public function getList($debut = -1, $limite = -1)
    {
        $sql = "SELECT * FROM users";

        if($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $listUser = $requete->fetchAll();

        foreach ($listUser as $user)
        {
            $user->setInscription(new \DateTime('now'));
        }
        $requete->closeCursor();

        return $listUser;
    }
    /**
     * change user role
     * @param int $id
     */
    public function switchUserRole( $id )
    {
        $user = $this->getUnique($id);
        if($user->role() == 'ADMIN')
        {
            $user->setRole('USER');
            $this->save($user);
        }
        elseif($user->role() == 'USER')
        {
            $user->setRole('ADMIN');
            $this->save($user);
            $_SESSION['role'] = 'ADMIN';
        }
    }
    /**
     * Check if exist a user in BDD
     * @param object $user
     * @return mixed
     */
    public function checkUserForRegister($id, $username)
    {
        $q = $this->dao->prepare('SELECT * FROM users WHERE username = :username AND id != :id');
        $q->bindValue('username', $username);
        $q->bindValue('id', $id);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        
        if(empty($q->fetch()))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
        
}