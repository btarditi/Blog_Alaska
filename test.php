<?php
namespace Model;
use \Entity\Users;
class UsersManagerPDO extends UsersManager
{
    protected function insert(Users $user)
    {
        $q = $this->dao->prepare('INSERT INTO t_user SET username = :username, password = :password, salt = :salt, role = :role');
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        $q->execute();
        $user->setId($this->dao->lastInsertId());
    }
    public function find($id)
    {
        $q = $this->dao->prepare('SELECT id, username, password, salt, role FROM t_user WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');
        return $q->fetch();
    }
    public function findByUsername($username)
    {
        $q = $this->dao->prepare('SELECT id, username, password, salt, role FROM t_user WHERE username = :username');
        $q->bindValue(':username', $username);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');
        return $q->fetch();
    }
    public function findAll()
    {
        $q = $this->dao->query('SELECT id, username, password, salt, role FROM t_user ORDER BY role, username ');
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');
        return $users = $q->fetchAll();
    }
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM t_user ')->fetchColumn();
    }
    protected function update(Users $user)
    {
        $q = $this->dao->prepare('UPDATE t_user SET username = :username, password = :password, salt = :salt, role = :role  WHERE id = :id');
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        $q->bindValue(':id', $user->id());
        $q->execute();
    }
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM t_user WHERE id = '.(int) $id);
    }
}