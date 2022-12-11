<?php
session_start();
include ('conf.php');
?>

<style>
ul {
    list-style-type: none;

    display: inline-flex;
}

li {
    margin-left: 15px;
}

* {
    font-size: 20pt;
}

td {
    border: 1px solid black;
}

th {
    border: 1px solid black;

}

table {
    margin-left: auto;
    margin-right: auto;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<div style="width: 100%;height:100px;background-color:aqua">
    <ul>
        <li>user_name: <?php echo $_SESSION['name'] ?></li>
        <li>user_id: <?php echo $_SESSION['id'] ?></li>
        <li><a href="logout.php">logout</a></li>
    </ul>
</div>

<div style="margin-top:10px;float:right;width: 300px;height:200px;background-color:#fff9c4">
    <?php
$rd=$_SESSION['id'];
$mes="SELECT * FROM `login` where user_id!='$rd'";
$qmes=mysqli_query($conn,$mes);
while($row=mysqli_fetch_assoc($qmes)){
    $rowid=$row['user_id'];
    echo $row['name']." <a href='message.php?user_id=$rowid' ><i class='fa-regular fa-envelope'></i></a><br><br>";
}

?>
</div>

<form action="" method="POST" enctype="multipart/form-data">
    <br><br>
    name:
    <input type="text" name="name" /><br><br>
    img:
    <input type="file" name="upload" /><br><br>
    save:
    <button name="save">save</button>

</form>

<?php
$rd=$_SESSION['id'];
if(isset($_POST["save"])){
$name = $_POST['name'];
$filename=$_FILES['upload']['name'];
$temp=$_FILES['upload']['tmp_name'];
$folder='img/'.$filename ;
move_uploaded_file($temp,$folder);
if(!$name==''){
$query="INSERT INTO `img2`(user_id,name,img) VALUES ('$rd','$name','$folder')";
$data=mysqli_query($conn,$query);
if ($data){
    echo "yes mission completed";
}
else {
    echo "none";
}
}
}
?>
<?php
$q="SELECT * FROM `img2` where user_id='$rd'";
$data=mysqli_query($conn,$q);
$display=mysqli_num_rows($data);
if($display != 0){
    ?>

<table>
    <tr>
        <th>name</th>
        <th>image</th>
    </tr>

    <?php
     while($result=mysqli_fetch_assoc($data)){
        echo "<tr>
        <td>".$result["name"]."</td>
        <td><img src=".$result['img']." height='300' width='300' /></td>
        </tr>";
     }

}
?>