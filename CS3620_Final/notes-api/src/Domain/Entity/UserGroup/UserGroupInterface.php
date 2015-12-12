<?php
/**
 * File name: UserGroupInterface.php
 * Project: notes-api
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
use Notes\Domain\ValueObject\Uuid;

interface UserGroupInterface
{
    /**
     * @param \Notes\Domain\Entity\User $user
     * @return bool
     */
    public function addUser(User $user);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function getUsers();

    /**
     * @param Uuid $uuid
     * @return bool
     */
    public function removeById(Uuid $uuid);
}
