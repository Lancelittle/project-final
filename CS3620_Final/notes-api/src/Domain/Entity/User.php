<?php
/**
 * File name: User.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @package   Notes\Domain\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Notes\Domain\Entity;

use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

/**
 * Class User
 * @category  PHP
 * @package   Notes\Domain\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class User
{
    /** @var \Notes\Domain\ValueObject\Uuid */
    protected $id;

    /** @var \Notes\Domain\ValueObject\StringLiteral */
    protected $username;

    protected $isAdmin;

    protected $isOwner;

    public function __construct(Uuid $uuid)
    {
        $this->id = $uuid;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function getIsOwner()
    {
        return $this->isOwner;
    }

    public function setIsOwner($isOwner)
    {
        $this->isOwner = $isOwner;
    }

    /**
     * @return StringLiteral
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param StringLiteral $username
     * @return $this
     */
    public function setUsername(StringLiteral $username)
    {
        $this->username = $username;

        return $this;
    }
}
