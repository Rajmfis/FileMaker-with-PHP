<?php
session_start();
include 'lib/FileMaker.php';
$fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');
$newRecord=$fm->newAddCommand('users');

$newRecord->setField('first_name',$_POST['firstname']);
$newRecord->setField('last_name',$_POST['lastname']);
$newRecord->setField('email_id',$_POST['emailid']);
$newRecord->setField('contact_no',$_POST['contactno']);
$newRecord->setField('created_by',$_POST['adminemail']);
$newRecord->setField('pwd',$_POST['password']);

$result=$newRecord->execute();

if(FileMaker::isError($result)){
    $error=$result->getMessage();
    echo $error;
    exit();
}else{
    echo "You are registered with us";
}

?>

