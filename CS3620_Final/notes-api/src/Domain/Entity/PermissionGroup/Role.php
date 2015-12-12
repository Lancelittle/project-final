<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 11/24/15
 * Time: 6:24 PM
 */

namespace Notes\Domain\Entity\PermissionGroup;

use Notes\Domain\ValueObject\Uuid;

class Role
{
    private $id;
    private $permissions;

    public function __construct(Uuid $uuid)
    {
        $this->id = $uuid;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function  setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }
}