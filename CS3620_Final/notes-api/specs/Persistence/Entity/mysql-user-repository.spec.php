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

use Notes\Domain\Entity\UserFactory;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Persistence\Entity\MySqlUserRepository;
use Notes\Db\Adapter\MySqlDatabase;

describe('Notes\Persistence\Entity\MySqlUserRepository', function () {
    beforeEach(function () {
        $db = new MySqlDatabase();
        $this->repo = new MySqlUserRepository($db);
        $this->userFactory = new UserFactory();
        $this->uuid = new Uuid();
        $this->user = new User($this->uuid);
        $this->user->setUsername(new StringLiteral("test000"));
        $this->user->setIsAdmin(1);
        $this->user->setIsOwner(0);
    });
    describe('->__construct()', function () {
        it('should construct an MySqlUserRepository object', function () {
            expect($this->repo)->to->be->instanceof('Notes\Persistence\Entity\MySqlUserRepository');
        }) ;
    });
    describe('->count()', function () {
        it('should return count of user table', function () {
            $this->repo->add($this->user);

            $value = $this->repo->getUsers();
            expect($this->repo->count($value))->equal(1);
            $this->repo->removeById($this->uuid);
        });
    });
    describe('->add()', function () {
        it('should add and remove 1 user', function () {
            expect($this->repo->add($this->user))->to->equal(true);
            expect($this->repo->removeById($this->uuid))->to->equal(true);
        });
    });
    describe('->getById()', function () {
        it('should return a single User object', function () {
            $this->repo->add($this->user);

            /** @var \Notes\Domain\Entity\User $actual */
            $actual = $this->repo->getById($this->uuid);

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');
            expect($actual->getId()->__toString())->to->be->equal($this->user->getId()->__toString());
            expect($actual->getUsername()->__toString())->to->be->equal($this->user->getUsername()->__toString());
            expect($actual->getIsAdmin())->to->be->equal($this->user->getIsAdmin());
            expect($actual->getIsOwner())->to->be->equal($this->user->getIsOwner());

            $this->repo->removeById($this->uuid);
        });
    });
    describe('->getUsers()', function () {
        it('should return array of users', function () {
            $this->repo->add($this->user);

            $value = $this->repo->getUsers();
            expect($this->repo->count($value))->equal(1);
            $this->repo->removeById($this->uuid);
        });
    });
});
