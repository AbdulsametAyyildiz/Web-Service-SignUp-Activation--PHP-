<?php
include("connect.php");

$code = rand(10000,100000);

$userName = $_POST["userName"];
$password = $_POST["password"];
$userMail = $_POST["userMail"];
$cases = 0;

$query = mysqli_query($connect,"select * from sentMail where userName = '$userName' or userMail = '$userMail'" );
$row = mysqli_num_rows($query);

if(($row)>0){
    echo(json_encode_tr(array('Result'=>false)));
    echo(json_encode_tr(array('Case'=>'Same Record')));
}
else{
    $add = mysqli_query($connect,"insert into sentMail(userName,password,userMail,cases,code) values ('$userName','$password','$userMail','$cases','$code')");
    if($add){
        $to = $userMail;
        $subject = "You must confirm email";
        $message = "Hello $userName you can confirm your email from link bellow http:**your site**/conMail.php?mail=$userMail&code=$code";
        $sender= "From: <mail address>";
        
        $sendMail = mail($to,$subject,$message,$sender);
        
        if($sendMail) {echo(json_encode(array('Case'=>'Please confirm your email')));
            
            echo(json_encode(array('Result'=>true)));
        }
    }
    else  echo(json_encode(array('Result'=>false)));
}

?>