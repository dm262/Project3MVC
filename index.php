<?php
//require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_login';
    }
}

switch ($action) {
    case 'show_login': {
        include('views/login.php');
        break;
    }

    case 'validate_login.php':{
        $email = filter_input(INPUT_POST,'email');
        $password =filter_input(INPUT_POST,'password');

        if ($email == NULL || $password == NULL){
            $error ='Email and password must be included';
            include ('errors/error.php');
        }else{
            $isValidLogin = validate_login($email, $password);
            if (!$isValidLogin){
                //TODO redirect to registration
                echo 'go to REg';
            }else{
                $userid =$isValidLogin[0]['id'];
                header('location:.?action=display_questions&userId=$userid');
            }
        }
        break;
    }

    case 'display_questions.php':{
        $userid =filter_input(INPUT_GET,'userId');
        if ($userid == NULL || $userid < 0 ){
            header('location: .?action=display_login');
        }else{
            $questions =getUsersQuestion($userid);

        }
        include ('views/display_questions.php');

        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }
}