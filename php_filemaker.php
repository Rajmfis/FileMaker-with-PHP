<?php
include 'lib/FileMaker.php';
$fm=new FileMaker('users1.fmp12','172.16.9.184','admin','mindfire');
$newRecord=$fm->newAddCommand('users');

$newRecord->setField('first_name',$_POST['firstname']);
$newRecord->setField('last_name',$_POST['lastname']);
$newRecord->setField('email_id',$_POST['emailid']);
$newRecord->setField('contact_no',$_POST['contactno']);
$newRecord->setField('created_by',$_POST['adminemail']);
$newRecord->setField('pwd',$_POST['password']);

// $newRecord->setField('first_name','rajan');
// $newRecord->setField('last_name','mohapatra');
// $newRecord->setField('email_id','re@gmail.com');
// $newRecord->setField('contact_no','3232323232');
// $newRecord->setField('created_by','re@gmail.com');
// $newRecord->setField('pwd','Raj@1');
// $newRecord->setField('id','1');

$result=$newRecord->execute();

if(FileMaker::isError($result)){
    $error=$result->getMessage();
    ?>
    <h2>Error:<?php echo $error;?></h2>
    <?php
    exit;
}else{
    ?>
    <h2>You are registered with us</h2>
    <?php
}?>

<!-- last_name,email_id,contact_no,created-by,pwd,id -->

