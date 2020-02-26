<?php
    include 'lib/FileMaker.php';

    $fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');
    $q = $fm -> newFindCommand('Activity');
    $q -> addFindCriterion('activity_name', '=='.$_POST['activityname']);
    $result=$q->execute();

    $records = $result->getRecords();
    $recordId = $records[0]->getRecordId();
    // $q -> addFindCriterion('activity_name', '=='.$_POST['activityname']);
    $del=$fm->newDeleteCommand('Activity',$recordId);
    // $q -> addFindCriterion('pwd', '=='.$password);

    $r=$del->execute();
    if($r){
        echo "user deleted";
    }else{
        echo "user not deleted";
    }

?> 