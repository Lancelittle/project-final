<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\HttpFoundation\Request;
use Notes\Api\UserApi;

$app = new Application();

$app['debug'] = true;

$userApi = new UserApi();

$app->get('/', function () {
    return new Response('<h1>Rest API Final Project</h1>', 200);
});

$app->get('/users', function (Request $request) use($userApi) {
    return $userApi->getAllUsers($request);
});

$app->get('/users/{id}', function ($id) use($userApi) {
    return $userApi->getUserById($id);
});

$app->post('/users', function (Request $request) use($userApi) {
    return $userApi->insertUser($request);
});

$app->put('/users/{id}', function (Request $request, $id) use($userApi) {
    return $userApi->updateUserById($request, $id);
});

$app->delete('/users/{id}', function ($id) use($userApi) {
    return $userApi->removeUserById($id);
});

$app->run();
