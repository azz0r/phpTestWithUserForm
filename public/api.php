<?php

try {
    // set things up with init and config
    require_once('init.php');

    // module defines where we end up
    $module = isset($_GET['module']) ? $_GET['module'] : 'user';

    // define id so we can get it quick
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // we return results in a json format
    $result = array();

    // switch the area were in
    switch ($module) {
        //thing is a test object
        case 'user': default;
            $result = new Controller_User_Create($_POST);
        break;
    }


} catch (Exception $e) {
    $result = $e->getMessage();
}

// send the json headers
header('Content-type: text/json');
header('Content-type: application/json');

if (isset($result->errors) && !empty($result->errors)) {
    header('HTTP/1.0 403 Forbidden');
}

// echo the result in a json format
echo json_encode($result);

//close the page
exit;