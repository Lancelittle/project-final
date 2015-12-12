<?php
/**
 * File name: InMemoryUserRepository.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @package   Notes\Persistence\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Notes\Persistence\Entity;

use InvalidArgumentException;
use Notes\Domain\Entity\User;
use Notes\Domain\Entity\UserRepositoryInterface;
use Notes\Domain\ValueObject\Uuid;

/**
 * Class InMemoryUserRepository
 * @category  PHP
 * @package   Notes\Persistence\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class InMemoryUserRepository implements UserRepositoryInterface
{
    /** @var array */
    protected $users;

    /**
     * InMemoryUserRepository constructor
     */
    public function __construct()
    {
        $this->users = [];
    }

    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function add(User $user)
    {
        if (!$user instanceof User) {
            throw new InvalidArgumentException(
                __METHOD__ . '(): $user has to be a User object'
            );
        }

        $this->users[] = $user;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->users);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function getById(Uuid $uuid)
    {
        foreach($this->users as $user) {
            /** @var \Notes\Domain\Entity\User $user*/
            if ($user->getId() == $uuid) {
                return $user;
            }
        }
    }

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

    /**
     * @param \Notes\Domain\ValueObject\Uuid $uuid
     * @param \Notes\Domain\Entity\User $user
     * @return bool
     */
    public function modifyById(Uuid $uuid, User $user)
    {
        $this->removeById($uuid);
        $this->add($user);
        $this->users = array_values($this->users);
    }
}
