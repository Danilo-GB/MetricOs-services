<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->post('metric-os-api/query', 'UserDatabaseController@makeQuery');
$router->post('metric-os-api/switch-db', 'UserDatabaseController@switchDatabase');
$router->post('metric-os-api/add-db', 'UserDatabaseController@addDatabase');
$router->post('metric-os-api/read-dbs', 'UserDatabaseController@readDatabases');
$router->post('metric-os-api/delete-db', 'UserDatabaseController@deleteDatabase');

$router->post('metric-os-api/add-dashboard', 'DashboardController@addDashboard');
$router->post('metric-os-api/read-dashboards', 'DashboardController@readDashboard');

$router->post('metric-os-api/read-components', 'ComponentController@readComponents');
$router->post('metric-os-api/save-component', 'ComponentController@saveComponent');
$router->post('metric-os-api/move-component', 'ComponentController@moveComponents');
$router->post('metric-os-api/resize-component', 'ComponentController@resizeComponents');

$router->post('metric-os-api/add-st-dashboard', 'StatisticsController@addStDashboard');
$router->post('metric-os-api/read-st-dashboards', 'StatisticsController@readStDashboard');

$router->post('metric-os-api/read-st-components', 'ComponentStController@readStComponents');
$router->post('metric-os-api/save-st-component', 'ComponentStController@saveStComponent');
$router->post('metric-os-api/move-st-component', 'ComponentStController@moveStComponents');
$router->post('metric-os-api/resize-st-component', 'ComponentStController@resizeStComponents');
