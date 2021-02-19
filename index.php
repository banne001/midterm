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
    $f3->set("surveys", array('This midterm is easy', 'This midterm is hard', 'I like midterms', 'Today is Monday'));

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = trim($_POST['fname']);


        //If the data is valid --> Store in session
        if(!empty($name) && ctype_alpha($name)) {
            $_SESSION['name'] = $name;
        } else {
            $f3->set('errors["name"]', "Name cannot be blank and must only contain characters");
        }

        if(isset($_POST['survey'])) {
            $survey = $_POST['survey'];
            $_SESSION['survey'] = implode(", ", $survey);
        } else {
            $f3->set('errors["survey"]', "Select a meal");
        }
        if(empty($f3->get('errors'))){
            $f3->reroute("/summary");
        }
    }
    $f3->set('name', isset($name) ? $name: "");
    $f3->set('survey', isset($survey) ? $survey : "");

    $view = new Template();

    echo $view->render('views/survey.html');
});
$f3->route('GET|POST /summary', function () {
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});
//Run fat free
$f3->run();

