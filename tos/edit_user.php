 <?php
session_start();
?>
<!DOCTYPE html>
<html>

	<title>Traffic Offence System</title>
	<link rel="stylesheet" href='css/dcss.css'

<body>
<aside>
	<div class='user'>
		<img class='avatar' src='img/avatar.png'>
	<?php
// Echo session variables that were set on previous page
echo "<p> User: " . $_SESSION["username"] . "<br></p>";
?>
<a href="logout.php">logout</a><hr/>
</div>

<ul class='nav_container'>
	<li class='nav_list'><a href='dashboard.php'>Home</li><hr/>
	<li class='nav_list'><a href='add_offence.php'>Add Offence</li><hr/>
	<li class='nav_list'><a href='view_offence.php'>View Offence</li><hr/>
	<li class='nav_list'><a href='edit_user.php'>Edit Profile</li><hr/>
	<li class='nav_list'><a href='#'>About Us</li><hr/>
	<li class='nav_list'><a href='#'>Contact Us</li></a><hr/>
</ul>

</aside>
<section>
    <?php
    
require_once 'dbconn.php';
    $user=$_SESSION['username'];
    $query="SELECT id, fname,lname,email,username FROM user WHERE username='$user'";
            $result=$conn->query($query);
            if(!$result){
                echo 'failed';
            }
			else{
    $row=$result->fetch_assoc();
           } 
    ?>
<?php
if(isset($_POST['update'])) //check if browser has posted any data to be collected

{
	$username = get_post($conn, 'username');//check if inputed data contain escape sequence such as /n

$fname = get_post($conn, 'fname');
$lname = get_post($conn, 'lname');
$email = get_post($conn, 'email');
	$query= "UPDATE user SET fname='$fname',lname='$lname',email='$email' WHERE username='$user'"; //insert data to database
	$result= $conn->query($query);
    if (!$result){
	echo "<script>alert('failed');</script>"; 
    }
	echo "<script>alert('Profile Update');</script>";
}
    
    function get_post($conn, $var)
{
return $conn->real_escape_string($_POST[$var]);
}
?>
<div class="login-page">
		<div class="form_edit">
<form action='' method='post'>
	<h2>Edit</h2><hr/>
        <label>Id</label>
	<input type='text' name='id' value="<?php echo 'tos000'.$row['id']?>" disabled/><br>
        <label class='lab'>first Name</label>
	<input type='text' name='fname' value="<?php echo $row['fname']?>"/><br>
	<label class='lab'>Last Name</label>
	<input type='text' name='lname' value="<?php echo $row['lname']?>" /><br>
	<label class='lab'>Username</label>
	<input type='text' name='username' value="<?php echo $row['username']?>" disabled/><br>
<label>Email</label>
	<input type='e-mail' name='email' value="<?php echo $row['email']?>"/><br>

	<input class='btn' type='submit'name='update' value='update'>
        <button class='btn' onclick="windows.location='change_pwd.php'"> Change Password </button>
</section>
</body>
<footer> UGANDA POLICE FORCE &copy; 2020 </footer>
</html> 
