<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 07/06/19
 * Time: 14.53
 */

use Santino83\CR\Controller\CountryController;
use Santino83\CR\Controller\UserController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('user', new Route('/user/{username}',['_controller'=> UserController::class.'::getUserAction']));
$routes->add('country', new Route('/user/{username}/country/{country_id}',['_controller'=> CountryController::class.'::getCountryAction']));
$routes->add('countries', new Route('/user/{username}/countries',['_controller'=> CountryController::class.'::getCountriesAction']));

return $routes;