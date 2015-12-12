<?php
/**
 * File name: user-group-admin.spec.php
 * Project: notes-api
 * PHP version 5
 * @category  PHP
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

use Notes\Domain\Entity\UserGroup\Owners;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\UserGroup\Owners', function () {
    describe('->__construct()', function () {
        it('should return an Owner object', function () {
            $actual = new Owners();
            expect($actual)->to->be->instanceof('\Notes\Domain\Entity\UserGroup\Owners');
        });
    });
    describe('->getUsers()', function () {
        it('should return the Owner\'s list of users', function () {
            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('mbrow234'));
            $value[] = $user;
            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('randomUser1'));
            $value[] = $user;
            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('coolUser85'));
            $value[] = $user;

            $actual = new Owners();
            $actual->setUsers($value);
            $users = $actual->getUsers();
            expect($users)->equal($value);
        }) ;
    });
    describe('->setUsers($array)', function () {
        it('should set and then return the Owners list of users as an array', function () {

            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('mbrow234'));
            $value[] = $user;
            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('randomUser1'));
            $value[] = $user;
            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('coolUser85'));
            $value[] = $user;

            $actual = new Owners();
            $actual->setUsers($value);
            $users = $actual->getUsers();
            expect($users)->equal($value);
        });
    });
    describe('->removeById($uuid)', function () {
        it('should delete a user that the Owner is responsible for', function () {
            $uuid = new Uuid();
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('mbrow234'));
            $value[] = $user;
            $user = new User($uuid);
            $user->setUsername(new StringLiteral('randomUser1'));
            $value[] = $user;
            $removeUuid = new Uuid();
            $checkUser = new User($removeUuid);
            $checkUser->setUsername(new StringLiteral('coolUser85'));
            $value[] = $checkUser;

            $actual = new Owners();
            $actual->setUsers($value);
            $before = $actual->getUsers();

            $actual->removeById($removeUuid);
            $after = $actual->getUsers();
            expect(in_array($checkUser, $before));
            expect(!in_array($checkUser, $after));
        });
    });
    describe('->addUser($userName)', function () {
        it('should add a user to the Owner', function () {
            $value = array('mbrow234', 'randomUser1', 'coolUser85');
            $actual = new Owners();
            $actual->setUsers($value);
            $before = $actual->getUsers();
            $user = 'coolUserNew';
            $actual->addUser($user);
            $after = $actual->getUsers();
            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        });
    });
});
