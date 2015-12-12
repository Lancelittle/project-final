<?php
/**
 * Created by PhpStorm.
 * User: lance
 * Date: 12/10/2015
 * Time: 2:50 PM
 */

namespace Notes\Api;

use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\ValueObject\StringLiteral;
use Symfony\component\HttpFoundation\Request;

class JsonUserDecoder {

    public function decodeNewUser(Request $request) {
        if (!(0 === strpos($request->headers->get('Content-Type'), 'application/json'))) {
            return false;
        }

        $data = json_decode($request->getContent(), true);

        if (!array_key_exists ( 'username' , $data )){
            return false;
        }

        $newUser = new User(new Uuid());
        $newUser->setUsername(new StringLiteral($data['username']));

        if (array_key_exists( 'is_admin' , $data)) {
            $newUser->setIsAdmin($data['is_admin']);
        }

        if (array_key_exists( 'is_owner' , $data)) {
            $newUser->setIsOwner($data['is_owner']);
        }

        return $newUser;
    }

    public function decodeUpdateUser(Request $request, $id) {
        if (!(0 === strpos($request->headers->get('Content-Type'), 'application/json'))) {
            return false;
        }

        $data = json_decode($request->getContent(), true);

        if (!array_key_exists ( 'username' , $data )){
            return false;
        }
        $newUser = new User(new Uuid($id));
        $newUser->setUsername(new StringLiteral($data['username']));

        if (array_key_exists( 'is_admin' , $data)) {
            $newUser->setIsAdmin($data['is_admin']);
        }

        if (array_key_exists( 'is_owner' , $data)) {
            $newUser->setIsOwner($data['is_owner']);
        }

        return $newUser;
    }
}

