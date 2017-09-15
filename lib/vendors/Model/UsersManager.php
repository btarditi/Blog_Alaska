<?php
namespace Model;
use \Entity\Users;
use \BTFram\Manager;
class UsersManager extends Manager
{
    /**
     * Méthode permettant d'ajouter un utilisateur.
     * @param $user Users L'utilisateur à ajouter
     * @return void
     */
    abstract protected function insert(Users $user);
    
    /**
     * Méthode permettant d'enregistrer un utilisateur.
     * @param user Users L'utilisateur à enregistrer
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    public function save(Users $user)
    {
        if ($user->isValid())
        {
            $user->isNew() ? $this->insert($user) : $this->update($user);
        }
        else
        {
            throw new \RuntimeException('L\'utilisateur doit être validée pour être enregistrée');
        }
    }
    /**
     * Méthode retournant un utilisateur précis.
     * @param $id int L'identifiant de l'utilisateur à récupérer
     * @return Users L'utilisateur demandée
     */
    abstract public function find($id);
    
    /**
     * Return a user matching the supplied username..
     * @param string $username The user username.
     * @return \Entity\Users |throw an exception if no matching user is found
     */
    abstract public function findByUsername($username);
    
    /**
     * Return a list of all users, sorted by role and name
     * @return array A list of all users.
     */
    abstract public function findAll();
    
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
    abstract protected function update(Users $user);
    /**
     * Méthode permettant de supprimer un utilisateur.
     * @param $id int L'identifiant de l'utilisateur à supprimer
     * @return void
     */
    abstract public function delete($id);
}