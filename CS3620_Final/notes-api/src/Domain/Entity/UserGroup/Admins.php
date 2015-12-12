<?php
/**
 * File name: Admins.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @package   Notes\Domain\Entity\UserGroup
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Notes\Domain\Entity\UserGroup;

use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

/**
 * Class Admins
 * @category  PHP
 * @package   Notes\Domain\Entity\UserGroup
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class Admins implements UserGroupInterface
{
    private $users = [];
    /**
     * @param \Notes\Domain\Entity\User $user
     * @return bool
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return new StringLiteral('Admin');
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \Notes\Domain\Entity\User[] $users
     * @return bool
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @param Uuid $uuid
     * @return bool
     */
    public function removeById(Uuid $uuid)
    {
        foreach($this->users as $key => $user) {
            /** @var \Notes\Domain\Entity\User $user*/
            if ($user->getId() == $uuid) {
                unset($this->users[$key]);
                return true;
            }
        }

        return false;
    }
}
