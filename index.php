<?php
//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
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
$f3->route('GET|POST /survey', function ($f3) {
    $f3->set("survey", array('This midterm is easy', 'This midterm is hard', 'I like midterms', 'Today is Monday'));
    $view = new Template();

    echo $view->render('views/survey.html');
});
$f3->route('GET|POST /summary', function () {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['survey'] = implode(", ", $_POST['survey']);
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});
//Run fat free
$f3->run();