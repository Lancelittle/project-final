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

use PDOException;
use Notes\Domain\Entity\User;
use Notes\Domain\Entity\UserRepositoryInterface;
use Notes\Domain\ValueObject\Uuid;
use Notes\Db\Adapter\MySqlDatabase;

/**
 * Class InMemoryUserRepository
 * @category  PHP
 * @package   Notes\Persistence\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class MySqlUserRepository implements UserRepositoryInterface
{
    protected $db;

    /**
     * InMemoryUserRepository constructor
     */
    public function __construct()
    {
        $this->db = new MySqlDatabase();
    }

    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function add(User $user)
    {
        try
        {
            $this->db->CreateUser($user);

            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->db->CountUsers();
    }

    /**
     * @return mixed
     */
    public function getUsers($isAscending)
    {
        return $this->db->GetUsers($isAscending);
    }

    public function getById(Uuid $uuid)
    {
        return $this->db->GetUser($uuid);
    }

    public function removeById(Uuid $uuid)
    {
        try
        {
            $this->db->DeleteUser($uuid);

            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $uuid
     * @param \Notes\Domain\Entity\User $user
     * @return bool
     */
    public function modifyById(Uuid $uuid, User $user)
    {
        if(!$this->removeById($uuid)) {
            return false;
        }

        $this->add($user);
        return true;
    }
}
