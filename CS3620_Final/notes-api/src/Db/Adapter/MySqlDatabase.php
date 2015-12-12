<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 12/8/15
 * Time: 6:13 PM
 */

namespace Notes\Db\Adapter;

use PDOException;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\ValueObject\StringLiteral;
use PDO;

/**
 * Class MySqlDatabase
 * @package Notes\Persistence
 */
class MySqlDatabase implements PdoInterface
{
    /**
     * @var string
     */
    protected $servername;
    /**
     * @var string
     */
    protected $dbname;
    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var PDO
     */
    protected $conn;

    /**
     * MySql constructor.
     */
    public function __construct()
    {
        $this->servername = "localhost";
        $this->dbname = "cs3620";
        $this->username = "root";
        $this->password = "";

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Hello";
        }
    }

    /**
     * @param User $data
     */
    public function CreateUser(User $data)
    {
        $sql = 'INSERT INTO user (uuid, username, is_admin, is_owner)
                VALUES (:uuid, :username, :is_admin, :is_owner)';
        $sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':uuid' => $data->getId()->__toString(), ':username' => $data->getUsername()->__toString(), ':is_admin' => $data->getIsAdmin(), ':is_owner' => $data->getIsOwner()));
    }

    /**
     * @return int
     */
    public function CountUsers()
    {
        $sql = "select count(*) from user";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        return intval($number_of_rows);
    }

    /**
     * @param Uuid $uuid
     */
    public function DeleteUser(Uuid $uuid)
    {
        $sql = "DELETE FROM user WHERE uuid='".$uuid->__toString()."'";
        $this->conn->exec($sql);
    }

    /**
     * @param Uuid $uuid
     * @return User|\PDOStatement
     */
    public function GetUser(Uuid $uuid)
    {
        $sql = 'SELECT * FROM user WHERE uuid = :uuid';
        $sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':uuid' => $uuid->__toString()));
        foreach ($sth as $row) {
            return $this->generateUserFromRow($row);
        }
    }


    /**
     * @param $isAscending
     * @return array or users
     */
    public function GetUsers($isAscending)
    {
        $sortBy = $isAscending? 'ASC' : 'DESC';
        $users = [];
        $sql = 'SELECT * FROM user ORDER BY username ' . $sortBy;
        $sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        foreach ($sth as $row) {
            $users[] = $this->generateUserFromRow($row);
        }
        return $users;
    }


    /**
     * @param $row
     * @return User
     */
    private function generateUserFromRow($row)
    {
        $id = new Uuid($row[0]);
        $user = new User($id);
        $user->setUsername(new StringLiteral($row[1]));
        $user->setIsAdmin(intval($row[2]));
        $user->setIsOwner(intval($row[3]));

        return $user;
    }

}
