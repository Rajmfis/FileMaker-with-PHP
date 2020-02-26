<?php
    session_start();
    // include 'lib/FileMaker.php';

    // $fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');
   

    $_SESSION["edit"]=true;
    $_SESSION["activityname"]=$_POST['activityname'];
    $_SESSION["startdate"]=$_POST['startdate'];
    $_SESSION["enddate"]=$_POST['enddate'];
    $_SESSION["starttime"]=$_POST['starttime'];
    $_SESSION["endtime"]=$_POST['endtime'];
    
    header("Location: activity.php");
?>