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
use Notes\Persistence\Entity\InMemoryUserRepository;

describe('Notes\Persistence\Entity\InMemoryUserRepository', function () {
    beforeEach(function () {
        $this->repo = new InMemoryUserRepository();
        $this->userFactory = new UserFactory();
    });
    describe('->__construct()', function () {
        it('should construct an InMemoryUserRepository object', function () {
            expect($this->repo)->to->be->instanceof(
                'Notes\Persistence\Entity\InMemoryUserRepository'
            );
        }) ;
    });
    describe('->add()', function () {
        it('should add 1 user', function () {
            $this->repo->add($this->userFactory->create());

            expect($this->repo->count())->to->equal(1);
        });
    });
    describe('->count()', function () {
        it('should add user and return 1 as count', function () {
            $this->repo->add($this->userFactory->create());

            expect($this->repo->count())->to->equal(1);
        });
    });
    describe('->getById()', function () {
        it('should return a single User object', function () {
            /** @var \Notes\Domain\Entity\User $user */
            $user = $this->userFactory->create();
            $user->setUsername(new StringLiteral('harrie'));
            $id = $user->getId();
            $this->repo->add($user);

            expect($this->repo->count())->to->be->equal(1);

            /** @var \Notes\Domain\Entity\User $actual */
            $actual = $this->repo->getById($id);

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');
            expect($actual->getUsername()->__toString())->to->be->equal('harrie');
        });
    });
    describe('->getUsers()', function () {
        it('should return array of users', function () {
            $user = $this->userFactory->create();
            $users[] = $user;
            $this->repo->add($user);

            $user = $this->userFactory->create();
            $users[] = $user;
            $this->repo->add($user);

            $value = $this->repo->getUsers();
            expect($users)->equal($value);
        });
    });
    describe('->removeById(Uuid $uuid)', function () {
        it('should add 2 users than remove one', function () {
            $user = $this->userFactory->create();
            $users[] = $user;
            $this->repo->add($user);
            $singleUserArray[] = $user;

            $uuid = new Uuid();
            $user = new User($uuid);
            $users[] = $user;
            $this->repo->add($user);

            $before = $this->repo->getUsers();
            expect($users)->equal($before);
            $this->repo->removeById($uuid);
            $after = $this->repo->getUsers();

            expect($after)->equal($singleUserArray);
        });
    });
    describe('->modifyById(Uuid $uuid)', function () {
        it('should add 2 users than modify one', function () {
            $user = $this->userFactory->create();
            $users[] = $user;
            $direct[] = $user;
            $this->repo->add($user);

            $oldUuid = new Uuid();
            $user = new User($oldUuid);
            $users[] = $user;
            $this->repo->add($user);

            $before = $this->repo->getUsers();
            expect($users)->equal($before);

            $newUuid = new Uuid();
            $user = new User($newUuid);
            $direct[] = $user;
            $this->repo->modifyById($oldUuid, $user);

            $after = $this->repo->getUsers();

            expect($after)->equal($direct);
        });
    });


//    public function modifyById(Uuid $uuid, User $user)
});
