<?php
session_start();
include 'lib/FileMaker.php';
$fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');

$newRecord=$fm->newAddCommand('Activity');

// $newRecord->setField('activity_name',$_POST['activity']);
// $newRecord->setField('start_date',$_POST['startdate']);
// $newRecord->setField('end_date',$_POST['enddate']);
// $newRecord->setField('start_time',$_POST['starttime']);
// $newRecord->setField('end_time',$_POST['endtime']);
// $newRecord->setField('userid',$_SESSION["id"]);

$newRecord->setField('userid',"25");
$newRecord->setField('comments',"04/05/2010");

// // $newRecord->setField('end_date',"04/05/2010");
// // $newRecord->setField('start_time',"04/05/2010");
// // $newRecord->setField('end_time',"04/05/2010");
// // $newRecord->setField('userid',"2");

$result=$newRecord->execute();

if(FileMaker::isError($result)){
    $error=$result->getMessage();
    // echo "
    //         <script type=\"text/javascript\">
    //         var e = document.getElementById('activity');
    //         setTimeout(function(){ e.innerHTML=\"There was some issue. Please try after sometime\";}, 2000);
    //         </script>
    //     ";
    //need to work on the success message
    echo $error;
    
}else{
    echo "success";
    // echo "
    //         <script type=\"text/javascript\">
    //         alert
    //         </script>
    //     ";
}

//retrieve current activities list
// function activities_list(){

		// $q = $fm -> newFindCommand('Activity');
		// $layout_object = $fm->getLayout('Activity');
		// $field_objects = $layout_object->getFields();
    	// $q -> addFindCriterion('userid', '=='."17");
    	// $r = $q->execute();

		// $record_objects = $r->getRecords();
		// // echo $r->getFields()[0];
		// // for($x=0;$x<count($r->getFields());$x++){
		// 	// 	echo $r->getFields()[$x]."\n";
		// 	// 	echo $r->getField($r->getFields()[$x])."\n";
		// 	// }
		// foreach($record_objects as $record_object) {
		// 	 foreach($field_objects as $field_object) {
		// 		$field_name = $field_object->getName();
		// 		 $field_val = $record_object->getField($field_name);
		// 		 echo $field_val."\n";

		// 		 //add json values one by one 
		// 		 //use $newArray[$key] = $value;
		// 	}
		// 	echo " "."\n";
		// }
	// }
?>