<?php
/**
 * Created by PhpStorm.
 * User: lance
 * Date: 12/10/2015
 * Time: 5:54 PM
 */

namespace Notes\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\component\HttpFoundation\Request;
use Notes\Persistence\Entity\MySqlUserRepository;
use Notes\Domain\ValueObject\Uuid;

class UserApi {

    /** @var  \Notes\Persistence\Entity\MySqlUserRepository */
    protected $mySql;

    public function __construct() {
        $this->mySql = new MysqlUserRepository();
    }

    public function getAllUsers($request) {
        $jsonUserEncoder = new JsonUserEncoder();
        $isAscending = true;

        if(isset($request->query->all()['sort-username']) &&
            $request->query->all()['sort-username'] == strtolower("desc")) {

            $isAscending = false;
        }


        $users = $this->mySql->getUsers($isAscending);
        $json = $jsonUserEncoder->encodeUsers($users);

        if( $json == false ) {
            $response = new Response(null, 404);
            return $response;
        }

        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Content-Length', strlen($json));

        return $response;
    }

    public function getUserById($id) {
        $jsonUserEncoder = new JsonUserEncoder();
        $user = $this->mySql->getById(new Uuid($id));

        if(!isset($user)) {
            $response = new Response(null, 404);
            return $response;
        }

        $json = $jsonUserEncoder->encodeUser($user);

        if( $json == false ) {
            $response = new Response(null, 404);
            return $response;
        }

        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Content-Length', strlen($json));

        return $response;
    }

    public function insertUser(Request $request) {
        $jsonUserDecoder = new JsonUserDecoder();
        $user = $jsonUserDecoder->decodeNewUser($request);

        if ($user == false) {
            $response = new Response("Incompatible data", 400);
            return $response;
        }

        if ($this->mySql->add($user) == false) {
            $response = new Response("Incompatible data", 400);
            return $response;
        }

        $response = new Response(null, 201);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function updateUserById(Request $request, $id) {
        $jsonUserDecoder = new JsonUserDecoder();
        $user = $jsonUserDecoder->decodeUpdateUser($request, $id);

        if ($user == false) {
            $response = new Response("Incompatible data", 400);
            return $response;
        }

        if( !$this->mySql->modifyById(new Uuid($id), $user)) {
            $response = new Response("Incompatible data", 400);
            return $response;
        }

        $response = new Response(null, 202);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function removeUserById($id) {
        if(!$this->mySql->removeById(new Uuid($id))) {
            $response = new Response("usersID $id does not exist.", 404);
            return $response;
        }

        $response = new Response(null, 202);

        return $response;
    }
}
