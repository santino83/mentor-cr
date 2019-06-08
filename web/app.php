<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 07/06/19
 * Time: 19.34
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$loader = require_once __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$container = include __DIR__.'/../src/container.php';
/**@var $container \Symfony\Component\DependencyInjection\ContainerBuilder */

$container->setParameter('routes', include __DIR__.'/../src/routes.php');
$container->setParameter('base_template_uri', __DIR__.'/../src/Resources/views');

$container->compile();

$context = $container->get('context');
$context->fromRequest($request);

$controllerResolver = $container->get(\Santino83\CR\Resolver\ControllerResolver::class);

try{
    $callable = $controllerResolver->resolve($request);

    $response = call_user_func_array($callable, [$request]);
}catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e){
    $response = new Response('Not Found', Response::HTTP_NOT_FOUND);
}catch (\Exception $ex){
    $response = new Response('An error occurred:'.$ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
}

$response->send();