<?php
session_start();
include 'lib/FileMaker.php';
// require('activity.php');
$fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');

if(!isset($_SESSION['email'])){
    header("Location: index.html");
    exit();
}

$email = $_SESSION['email'];
$password = $_SESSION['pwd'];

$q = $fm -> newFindCommand('users');
$q -> addFindCriterion('email_id', '=='.$email);
$q -> addFindCriterion('pwd', '=='.$password);

$r = $q->execute();

// // This is the login portion of the script
// if(empty($email) or empty($password)){

//     echo '{"message":"User or password field blank", "code":401}';

// }elseif(FileMaker::isError($r)){

//     if($r->code == 401){
//         echo '{"message":"User not found or password incorrect", "code":401}';
//     }else{
//         echo '{"message":"Unknown Error", code:'.$r->code.'}';
//     }

// }else{
// This happens if an account has a $username and $password that are found together.
    $account = $r -> getFirstRecord();
    $ID_Account = $account->getField('id');
    $firstname = $account->getField('first_name');
    $lastname = $account->getField('last_name');
    $contactno = $account->getField('contact_no');

    $logindata = array('ID_Account' => $ID_Account, 'firstname' => $firstname, 'lastname' => $lastname, 'Contact no' => $contactno);
    // echo json_encode($logindata);
// }

$_SESSION["id"] = "$ID_Account";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>
    <nav class="nav navbar navbar-expand-lg navbar-light " style="background-color: #68a5d1;">
        <a class="navbar-brand" href="#" style="font-family: \'Courgette\', cursive;\
          ;font-size: xx-large;">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"> <span
                class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"> <a class="nav-link" href="#"><span
                            style="color:whitesmoke;font-size: x-large;">Profile Page</span></a>
                </li>
                <li class="nav-item needmargin"> <a class="nav-link" href="#"><span
                            style="color:whitesmoke;font-size:x-large;">Subscription</span></a>
                </li>
                <li class="nav-item needmargin">
                    <a class="nav-link" href="sessiondestroy.php">
                        <span style="color:whitesmoke;font-size:x-large;">Logout</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="profile-info" style="padding:20px 20px;">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome <?php echo $firstname?></h5>
                        <p class="card-text">You are subscribed for our Services</p>
                        <a href="#" class="btn btn-primary">Explore more about new Services</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile Details: </h5>
                        <p class="card-text">Name: <?php echo $firstname .' '. $lastname?></p>
                        <p class="card-text">Email: <?php echo $email ?></p>
                        <p class="card-text">Contact Details: <?php echo $contactno ?></p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" id="activity">
            <div class="col-sm-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                            aria-selected="true"><span style="font-weight:bold;">Please click here to record your
                                activity</span></a>
                    </li>
                </ul>
                <br>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <!--action="activity.php" -->
                        <form  method="POST" id="activityform" class="container">
                            <div class="form-group">
                                <label for="firstname">Activity Name</label>
                                <input type="text" id ="activityname" class="form-control" name="activity">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="firstname">Start date</label>
                                    <input type="date" id="startdate" class="form-control" name="startdate">
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname">End date</label>
                                    <input type="date" id="enddate" class="form-control" name="enddate">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="firstname">Start time</label>
                                    <input type="time" id="starttime" class="form-control" name="starttime">
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname">End time</label>
                                    <input type="time" id="endtime" class="form-control" name="endtime">
                                </div>
                            </div>
                            <input type="submit" class=" btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="table" data-toggle="tab" href="#tableview" role="tab"
                            aria-controls="home" aria-selected="true"><span
                                style="font-weight:bold;font-size:medium">Your Past Activities Record</span></a>
                    </li>
                </ul>
                <br>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane" id="tableview" style="height: 200px; overflow-y:scroll;" role="tabpanel" aria-labelledby="table"><br>
                        <table style="border:1;" id="activitytable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Activity Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Start time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <!--JSON needs to be displayed here by calling the function -->
                            <?php 
                                // function calling here to get the associative array
                                $q = $fm -> newFindCommand('Activity');
		                        $layout_object = $fm->getLayout('Activity');
		                        $field_objects = $layout_object->getFields();
    	                        $q -> addFindCriterion('userid', '=='.$_SESSION["id"]);
    	                        $r = $q->execute();

		                        $record_objects = $r->getRecords();
		                        // // echo $r->getFields()[0];
		                        // // for($x=0;$x<count($r->getFields());$x++){
		                        // 	// 	echo $r->getFields()[$x]."\n";
		                        // 	// 	echo $r->getField($r->getFields()[$x])."\n";
		                        // 	// }
		                        $arr=array();
		                        foreach($record_objects as $record_object) {
			                        $newArray = array();
			                        foreach($field_objects as $field_object) {
				                        $field_name = $field_object->getName();
				                        $field_val = $record_object->getField($field_name);
				                        $newArray[$field_name] = $field_val;
			                        }
			                        array_push($arr,$newArray);
		                            }
                                $result=$arr;
                                for($index=0;$index<count($result); $index++) {
                                 ?>
                            <tr>
                                <td><?php echo $result[$index]['activity_name']; ?></td>
                                <td><?php echo $result[$index]['start_date'];; ?></td>
                                <td><?php echo $result[$index]['end_date']; ?></td>
                                <td><?php echo $result[$index]['start_time'] ?></td>
                                <td><?php echo $result[$index]['end_time']; ?></td>
                                <td scope="col"><button class="button" onclick="editActivities(this)" >Edit</button></td>
                                <td scope="col"><button onclick="deleteActivities(this)">Delete</button></td>
                            </tr>
                            <?php
                                }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="activity.js"></script>
    <script src="index.js"></script>
</body>

</html>