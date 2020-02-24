<?php
header('Cache-Control: no-cache, must-revalidate');
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
// This happens if an account has a $username and $password that are found together.
    $account = $r -> getFirstRecord();
    $ID_Account = $account->getField('id');
    $firstname = $account->getField('first_name');
    $lastname = $account->getField('last_name');
    $contactno = $account->getField('contact_no');

    $logindata = array('ID_Account' => $ID_Account, 'firstname' => $firstname, 'lastname' => $lastname, 'Contact no' => $contactno);
    // echo json_encode($logindata);
}

$_SESSION["email"] = $_POST['emailId'];
$_SESSION["password"] = $_POST['pwd'];

$_SESSION["firstname"] = $firstname;
$_SESSION["lastname"] =$lastname;
$_SESSION["contactno"] =$contactno;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<nav class="nav navbar navbar-expand-lg navbar-light " style="background-color: #68a5d1;">
          <a class="navbar-brand" href="#" style="font-family: \'Courgette\', cursive;\
          ;font-size: xx-large;">Home</a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarText">
             <ul class="navbar-nav ml-auto">
               <li class="nav-item"> <a class="nav-link" href="#"><span style="color:whitesmoke;font-size: x-large;">Profile Page</span></a>
               </li>
                <li class="nav-item needmargin"> <a class="nav-link" href="#"><span style="color:whitesmoke;font-size:x-large;">Subscription</span></a>
                       </li>
               <li class="nav-item needmargin">
                 <a class="nav-link" href="sessiondestroy.php" >
                 <span style="color:whitesmoke;font-size:x-large;">Logout</span></a>
                </li>
             </ul>
           </div>
        </nav>
        <div class="profile-info">
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
       </div>
</body>
</html>