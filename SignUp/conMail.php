<?php
include("connect.php");

$code = $_GET["code"];
$mail = $_GET["mail"];

$control = mysqli_query($connect," select * from sentMail where code='$code' and userMail='$mail' and cases='0'");
$row = mysqli_num_rows($control);

if(($row)>0){
    $update = mysqli_query($connect,"update sentMail set cases='1' where code='$code' and userMail='$mail' and cases='0'");
    if($update){
        echo(json_encode_tr(array('Result'=>true)));
        echo(json_encode_tr(array('Case'=>'Email Activated')));
        
    }
    else {echo(json_encode_tr(array('Result'=>false)));
    echo(json_encode(array('Case'=>'This email is already active')));}
}
else {echo(json_encode_tr(array('Result'=>false)));
echo(json_encode(array('Case'=>'Incorrect activation code')));}

?>