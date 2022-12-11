<?php
session_start();
include ('conf.php');
$sender_id=$_SESSION['id'];
$sender_name=$_SESSION['name'];
if(isset($_GET['user_id'])){
    $mostalm_id=$_GET['user_id'];
}
?>
<style>
* {
    font-size: 20pt;
}
</style>

<form action="" method="POST">
    <input type="text" name="mes" />
    <button name="btn">send</button>
</form>

<?php
if(isset($_POST['btn'])){
    $message=$_POST['mes'];
    if($message != ''){
    $qmess="INSERT INTO `mseeage`(user1_id,user2_id,message) VALUES ('$sender_id','$mostalm_id','$message')";
    $result=mysqli_query($conn,$qmess);
    }
}
$read="SELECT * FROM `mseeage` WHERE (user1_id='$sender_id' AND user2_id='$mostalm_id')or(user1_id='$mostalm_id' AND user2_id='$sender_id')";
    $result_read=mysqli_query($conn,$read);
    while($rownn=mysqli_fetch_assoc($result_read)){
        $user1_id=$rownn['user1_id'];
        $get_name="SELECT * FROM `login` WHERE user_id='$user1_id'";
        $res_get=mysqli_query($conn,$get_name);
        $row=mysqli_fetch_assoc($res_get);
        $user1_name=$row['name'];
        echo $user1_name."=>>".$rownn['message']."<br><br>";
    }

?>