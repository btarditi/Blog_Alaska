<?php
namespace Model;

use \Entity\User;

class UserManagerPDO extends UserManager
{
    protected function insert(User $user)
    {
        $q = $this->dao->prepare('INSERT INTO users SET username = :username, password = :password');
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        $q->execute();
        $user->setId($this->dao->lastInsertId());
    }
    public function getUnique($id)
    {
        $q = $this->dao->prepare('SELECT id, username, password FROM users WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $q->fetch();
    }
    public function getByUsername($username)
    {
        $q = $this->dao->prepare('SELECT id, username, password FROM users WHERE username = :username');
        $q->bindValue(':username', $username);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $q->fetch();
    }
    public function getAll()
    {
        $q = $this->dao->query('SELECT id, username, password FROM Users ORDER BY username ');
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $user = $q->fetchAll();
    }
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM Users ')->fetchColumn();
    }
    protected function update(User $user)
    {
        $q = $this->dao->prepare('UPDATE Users SET username = :username, password = :password WHERE id = :id');
        $q->bindValue(':username', $user->username());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':salt', $user->salt());
        $q->bindValue(':role', $user->role());
        $q->bindValue(':id', $user->id());
        $q->execute();
    }
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM Users WHERE id = '.(int) $id);
    }
}


<?php
namespace Model;

use \Entity\User;
use \BTFram\Manager;

class UserManager extends Manager
{
    /**
     * Méthode permettant d'ajouter un utilisateur.
     * @param $user Users L'utilisateur à ajouter
     * @return void
     */
    abstract protected function insert(User $user);
    
    /**
     * Méthode permettant d'enregistrer un utilisateur.
     * @param user Users L'utilisateur à enregistrer
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    public function save(User $user)
    {
        if ($user->isValid())
        {
            $user->isNew() ? $this->insert($user) : $this->update($user);
        }
        else
        {
            throw new \RuntimeException('L\'utilisateur doit être validé pour être enregistré');
        }
    }
    
    /**
     * Méthode retournant un utilisateur précis.
     * @param $id int L'identifiant de l'utilisateur à récupérer
     * @return Users L'utilisateur demandée
     */
    abstract public function getUnique($id);
    
    /**
     * Return a user matching the supplied username..
     * @param string $username The user username.
     * @return \Entity\Users |throw an exception if no matching user is found
     */
    abstract public function getByUsername($username);
    
    /**
     * Return a list of all users, sorted by role and name
     * @return array A list of all users.
     */
    abstract public function getAll();
    
    /**
     * Méthode renvoyant le nombre d'utilisateur total.
     * @return int
     */
    abstract public function count();
    
    /**
     * Méthode permettant de modifier un utilisateur.
     * @param $user Users L'utilisateur à modifier
     * @return void
     */
    abstract protected function update(User $user);
    
    /**
     * Méthode permettant de supprimer un utilisateur.
     * @param $id int L'identifiant de l'utilisateur à supprimer
     * @return void
     */
    abstract public function delete($id);
}