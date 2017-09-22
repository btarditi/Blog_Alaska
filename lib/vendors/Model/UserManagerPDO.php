<?php
namespace Model;
use \Entity\User;
class UserManagerPDO extends UserManager
{
    /**
     * Get a user by id.
     * @param int $id
     * @return mixed
     */
    public function getUnique( $id)
    {
        $q = $this->dao->prepare('SELECT id, username, password, salt, role FROM users WHERE id = :id');
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
        $q = $this->dao->query('SELECT id, username, password, salt, role FROM users ORDER BY role, username ');
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
        $q = $this->dao->prepare('INSERT INTO users SET username = :username, password = :password, salt = :salt, role = :role');
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        $q->execute();
        $user->setId($this->dao->lastInsertId());
    }
    /**
     * Update un users
     * @param \Entity\Users $user
     */
    protected function update( User $user)
    {
        $q = $this->dao->prepare('UPDATE users SET username = :username, password = :password, salt = :salt, role = :role  WHERE id = :id');
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        $q->bindValue(':id', $user->id());
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
}