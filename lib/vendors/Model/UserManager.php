<?php
namespace Model;
use \Entity\User;
use \BTFram\Manager;
abstract class UserManager extends Manager
{
    /**
     * Insert a User in the BDD
     * @param $user Users The user to insert
     * @return void
     */
    abstract protected function insert(User $user);
    /**
     * Save the user in the BDD
     * @param Users $user
     * @return void
     * @internal param Users $user L'utilisateur à enregistrer
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
            throw new \RuntimeException('L\'utilisateur doit être validée pour être enregistrée');
        }
    }
    /**
     * Return a user matching the supplied id..
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
}