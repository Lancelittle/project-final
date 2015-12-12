<?php

namespace Notes\Db\Adapter;

use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\Uuid;
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 12/8/15
 * Time: 6:10 PM
 */
interface PdoInterface
{
    public function CreateUser(User $data);
    public function getUsers($isAscending);
    public function DeleteUser(Uuid $uuid);
    public function CountUsers();
}
