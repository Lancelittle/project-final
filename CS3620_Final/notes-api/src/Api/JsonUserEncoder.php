<?php
/**
 * Created by PhpStorm.
 * User: lance
 * Date: 12/10/2015
 * Time: 2:49 PM
 */

namespace Notes\Api;

use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;

class JsonUserEncoder {

    public function encodeString(StringLiteral $stringToEncode) {

        return json_encode($stringToEncode);
    }

    public function encodeUser(User $user) {
        $userInformation = [];

        $userInformation[] = [$user->getId()->__toString() => [
            'username' => $user->getUsername()->__toString()]];


        return json_encode($userInformation);
    }

    public function encodeUsers($users) {

        if ((sizeof($users) < 1) || (!($users[0] instanceof User))) {
            return false;
        }

        $usersInformation = [];

        foreach($users as $user) {
            $usersInformation[] = [$user->getId()->__toString() => [
                'username' => $user->getUsername()->__toString(),
                'is_admin' => $user->getIsAdmin(),
                'is_owner' => $user->getIsOwner()]];
        }

        return json_encode($usersInformation);
    }
}

