<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 11/24/15
 * Time: 6:24 PM
 */

namespace Notes\Domain\Entity\PermissionGroup;

use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

class Group
{
    private $id;
    private $roleId;
    private $users = [];
    private $name;

    public function __construct(Uuid $uuid)
    {
        $this->id = $uuid;
    }

    public function setId(Uuid $uuid)
    {
        $this->id = $uuid;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRoleId(Uuid $uuid)
    {
        $this->roleId = $uuid;
    }

    public function getRoldId()
    {
        return $this->roleId;
    }

    public function setUsers($users)
    {
        $this->users = $users;
    }

    public function addUser($user)
    {
        $this->users[] = $user;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function removeUserById(Uuid $uuid)
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

    public function setName(StringLiteral $name)
    {
        $this->name = $name;
    }

    /**
     * @return StringLiteral
     */
    public function getName()
    {
        return $this->name;
    }

}