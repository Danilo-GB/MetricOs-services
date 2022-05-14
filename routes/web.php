<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->post('metric-os-api/query', 'UserDatabaseController@makeQuery');

$router->post('metric-os-api/switch-db', 'UserDatabaseController@switchDatabase');

$router->post('metric-os-api/add-db', 'UserDatabaseController@addDatabase');

$router->post('metric-os-api/read-dbs', 'UserDatabaseController@readDatabases');

$router->post('metric-os-api/delete-db', 'UserDatabaseController@deleteDatabase');
