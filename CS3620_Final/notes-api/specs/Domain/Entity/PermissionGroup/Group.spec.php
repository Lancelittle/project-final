<?php
/**
 * File name: in-memory-user-repository.spec.php
 * Project: project-final_deliverable-1
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

use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\Entity\PermissionGroup\Group;
use Notes\Domain\Entity\User;

describe('Notes\Persistence\Entity\PermissionGroup\Group', function () {
    describe('->__construct()', function () {
        it('should construct a Group object', function () {

            $group = new Group(new Uuid());
            expect($group)->to->be->instanceof('\Notes\Domain\Entity\PermissionGroup\Group');
        }) ;
    });
    describe('->getRoldId()', function () {
        it('should return Uuid object', function () {
            $uuid = new Uuid();
            $group = new Group($uuid);
            expect($group->getId())->to->be->instanceof('Notes\Domain\ValueObject\Uuid');
        }) ;
    });
    describe('->setRoldId()', function () {
        it('should return Uuid object', function () {
            $uuid = new Uuid();
            $group = new Group($uuid);
            expect($group->getId())->to->be->instanceof('Notes\Domain\ValueObject\Uuid');
            expect($group->getId())->equal($uuid);
        }) ;
    });
    describe('->setUsers()', function () {
        it('should set and then return the Admins list of users as an array', function () {

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

            $actual = new Group(new Uuid());
            $actual->setUsers($value);
            $users = $actual->getUsers();
            expect($users)->equal($value);
        });
    });
    describe('->addUser(user)', function () {
        it('should return an array that contains the user', function () {
            $value = array('mbrow234', 'randomUser1', 'coolUser85');
            $actual = new Group(new Uuid());
            $actual->setUsers($value);
            $before = $actual->getUsers();
            $user = 'coolUserNew';
            $actual->addUser($user);
            $after = $actual->getUsers();
            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        }) ;
    });
    describe('->removeById($uuid)', function () {
        it('should delete a user that the admin is responsible for', function () {
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

            $actual = new Group(new Uuid());
            $actual->setUsers($value);
            $before = $actual->getUsers();

            $actual->removeUserById($removeUuid);
            $after = $actual->getUsers();
            expect(in_array($checkUser, $before));
            expect(!in_array($checkUser, $after));
        });
    });
    describe('->setName()', function () {
        it('should return the name of the group', function () {
            $uuid = new Uuid();
            $group = new Group($uuid);
            $group->setName(new StringLiteral('testName'));
            expect($group->getName()->__toString())->equal('testName');
        }) ;
    });
});
