<?php
//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the auto autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('Debug', 3);

//Define a default route (home page)
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});
$f3->route('GET /survey', function ($f3) {
    $f3->set("survey", array('This midterm is easy', 'This midterm is hard', 'I like midterms', 'Today is Monday'));
    $view = new Template();
    echo $view->render('views/survey.html');
    $this->_f3->reroute("/order2");
});

//Run fat free
$f3->run();