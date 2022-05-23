<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->post('metric-os-api/query', 'UserDatabaseController@makeQuery');
$router->post('metric-os-api/switch-db', 'UserDatabaseController@switchDatabase');
$router->post('metric-os-api/add-db', 'UserDatabaseController@addDatabase');
$router->post('metric-os-api/read-dbs', 'UserDatabaseController@readDatabases');
$router->post('metric-os-api/delete-db', 'UserDatabaseController@deleteDatabase');

$router->post('metric-os-api/config-app', 'PlatformDataController@configureApp');

$router->post('metric-os-api/add-dashboard', 'DashboardController@addDashboard');
$router->post('metric-os-api/read-dashboards', 'DashboardController@readDashboard');
$router->post('metric-os-api/delete-dashboard', 'DashboardController@deleteDashboard');

$router->post('metric-os-api/read-components', 'ComponentController@readComponents');
$router->post('metric-os-api/save-component', 'ComponentController@saveComponent');
$router->post('metric-os-api/move-component', 'ComponentController@moveComponents');
$router->post('metric-os-api/resize-component', 'ComponentController@resizeComponents');
