<?php
/**
 * File name: user.spec.php
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

use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\User', function () {
    describe('->__construct()', function () {
        it('should return a User object', function () {
            $actual = new User(new Uuid());

            expect($actual)->to->be->instanceof('\Notes\Domain\Entity\User');
        });
    });
    describe('->getId()', function () {
        it('should return the user\'s ID', function () {
            $uuid = new Uuid();
            $user = new User($uuid);

            $actual = $user->getId();
            expect($actual)->to->be->instanceof('Notes\Domain\ValueObject\Uuid');
            expect($actual->__toString())->equal($uuid->__toString());
        });
    });
    describe('->getUsername()', function () {
        it('should return the user\'s username', function () {
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('joe'));

            $actual = $user->getUsername();
            expect($actual)->to->be->instanceof('Notes\Domain\ValueObject\StringLiteral');
            expect($actual->__toString())->equal('joe');
        });
    });
});
