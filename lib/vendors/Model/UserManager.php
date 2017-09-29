<?php
namespace Model;

use \Entity\User;
use \BTFram\Manager;

/**
 * Class UserManager
 * Gestion des utilisateurs. 
 */
abstract class UserManager extends Manager
{
    /**
     * Insert un User dans la BDD
     * @param $user User The user to insert
     * @return void
     */
    abstract protected function insert(User $user);
    
    /**
     * Save un User dans la BDD
     * @param User $user
     * @return void
     * @internal param User $user L'utilisateur à enregistrer
     * @see self::insert()
     * @see self::update()
     */
    public function save(User $user)
    {
        if ($user->isValid())
        {
            $user->isNew() ? $this->insert($user) : $this->update($user);
        }
        else
        {
            throw new \RuntimeException('L\'utilisateur doit être validé pour être enregistrée');
        }
    }
    /**
     * Return un user par id..
     * @param integer $id The user id.
     * @return \Entity\Users |throw an exception if no matching user is found
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
    
    /**
     * Méthode permettant d'intervertir le rôle de l'utilisateur entre USER  || ADMIN
     * @param $id integer User Id
     * @return void
     */
    abstract public function switchUserRole($id);
    
    /**
     * Méthode permettant de verifier si l'utilisateur est dans la BDD
     * @param $id integer User Id
     * @return void
     */
    abstract public function checkUserForRegister($id, $username);
}