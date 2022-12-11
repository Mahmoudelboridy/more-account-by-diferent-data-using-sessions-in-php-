<?php
include ('conf.php');
?>
<style>
* {
    text-align: center;
    font-size: 20pt;
}

div {
    margin-top: 100px;
}
</style>
<div>
    <form action="indo.php" method="POST">
        <input type="text" name="name" /><br><br>
        <input type="password" name="pass" /><br><br>
        <button name="login">login</button>
    </form>
</div>

<?php
session_start();
if(isset($_POST['login'])){
$name=$_POST['name'];
$pass=$_POST['pass'];
$sql="SELECT * FROM `login` where
name='$name' and pass='$pass'";
$query=mysqli_query($conn,$sql);
$row=mysqli_num_rows($query);
if($row>0){
    $rown=mysqli_fetch_assoc($query);
    $_SESSION['id']=$rown['user_id'];
    $_SESSION['name']=$rown['name'];

echo "<script>alert('yes')</script>";
echo "<script>window.open('display.php','_self')</script>";

}
else{
    echo "<script>alert('no')</script>";
}
}


?>