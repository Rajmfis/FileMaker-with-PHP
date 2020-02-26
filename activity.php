<?php session_start();
include 'lib/FileMaker.php';
$fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');


//check whether the user is editing or not
if(isset($_SESSION["edit"])&& isset($_SESSION["activityname"])&&isset($_SESSION["startdate"])&&isset($_SESSION["enddate"])&&isset($_SESSION["starttime"])&&isset($_SESSION["endtime"])){
    $fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');
    $q = $fm -> newFindCommand('Activity');
    $q -> addFindCriterion('activity_name', '=='.$_SESSION["activityname"]);
    $q -> addFindCriterion('start_date', '=='.$_SESSION["startdate"]);
    $q -> addFindCriterion('end_date', '=='.$_SESSION["enddate"]);
    $q -> addFindCriterion('start_time', '=='.$_SESSION["starttime"]);
    $q -> addFindCriterion('end_time', '=='.$_SESSION["endtime"]);
    $q -> addFindCriterion('userid', '=='.$_SESSION["id"]);

    $result=$q->execute();

    $records = $result->getRecords();
    $recordId = $records[0]->getRecordId();
    $del=$fm->newDeleteCommand('Activity',$recordId);

    $r=$del->execute();
    $_SESSION["edit"]=false;
    unset($_SESSION['activityname']);
    unset($_SESSION['startdate']);
    unset($_SESSION['enddate']);
    unset($_SESSION['starttime']);
    unset($_SESSION['endtime']);
    exit();
}



$newRecord=$fm->newAddCommand('Activity');

$newRecord->setField('activity_name',$_POST['activity']);
$newRecord->setField('start_date',$_POST['startdate']);
$newRecord->setField('end_date',$_POST['enddate']);
$newRecord->setField('start_time',$_POST['starttime']);
$newRecord->setField('end_time',$_POST['endtime']);
$newRecord->setField('userid',$_SESSION["id"]);

$result=$newRecord->execute();

if(FileMaker::isError($result)){
    $error=$result->getMessage();
    echo $error;
}else{
    echo "Activity Added";
    exit();
}

//retrieve current activities list
function activities_list(){

		$q = $fm -> newFindCommand('Activity');
		$layout_object = $fm->getLayout('Activity');
		$field_objects = $layout_object->getFields();
    	$q -> addFindCriterion('userid', '=='.$_SESSION["id"]);
    	$r = $q->execute();

		$record_objects = $r->getRecords();
		$arr=array();
		foreach($record_objects as $record_object) {
			$newArray = array();
			$count=0;
			foreach($field_objects as $field_object) {
				$field_name = $field_object->getName();
				 $field_val = $record_object->getField($field_name);
				 $newArray[$field_name] = $field_val;
			}
			array_push($arr,$newArray);
		}
		
}



?>