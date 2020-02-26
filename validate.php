<?php
session_start();
include 'lib/FileMaker.php';

$fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');

$email = $_POST['emailId'];
$password = $_POST['pwd'];

$q = $fm -> newFindCommand('users');
$q -> addFindCriterion('email_id', '=='.$email);
$q -> addFindCriterion('pwd', '=='.$password);

$r = $q->execute();

// This is the login portion of the script
if(empty($email) or empty($password)){

    echo '{"message":"User or password field blank", "code":401}';

}elseif(FileMaker::isError($r)){

    if($r->code == 401){
        echo '{"message":"User not found or password incorrect", "code":401}';
    }else{
        echo '{"message":"Unknown Error", code:'.$r->code.'}';
    }

}else{
    $_SESSION["email"]=$_POST['emailId'];
    $_SESSION["pwd"]=$_POST['pwd'];

    header("Location: profile.php");
}

?>