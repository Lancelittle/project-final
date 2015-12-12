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
use Notes\Domain\Entity\PermissionGroup\Role;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Persistence\Entity\PermissionGroup\Role', function () {
    describe('->__construct()', function () {
        it('should construct a Role object', function () {
            $uuid = new Uuid();
            $role = new Role($uuid);
            expect($role)->to->be->instanceof('\Notes\Domain\Entity\PermissionGroup\Role');
        }) ;
    });
    describe('->getId()', function () {
        it('should return Id of Role', function () {
            $uuid = new Uuid();
            $role = new Role($uuid);
            expect($role->getId())->to->be->instanceof('\Notes\Domain\ValueObject\Uuid');
        });
    });
    describe('->getPermissions()', function () {
        it('should return an array of permissions', function () {
            /** @var \Notes\Domain\Entity\User $user */
            $uuid = new Uuid();
            $role = new Role($uuid);

            $array = ["admin", "owner"];
            $role->setPermissions($array);

            expect($role->getPermissions())->equal($array);
        });
    });
//    public function getByUsername($username);
//    public function getUsers();
//    public function modify(User $user);
//    public function remove(User $user);
//    public function removeByUsername($username);
});
