<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$user=$_POST['username'];
$pas=$_POST['password'];
$sql1=mysql_query("SELECT * FROM manager WHERE username='$user'")or die(mysql_error());
 $result=mysql_fetch_array($sql1);
 if($result>0){
$message="<font color=blue>sorry the username entered already exists</font>";
 }else{
$sql=mysql_query("INSERT INTO manager(first_name,last_name,staff_id,postal_address,phone,email,username,password,date)
VALUES('$fname','$lname','$sid','$postal','$phone','$email','$user','$pas',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_manager.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>

<html>
<head>
<title><?php echo $username;?> - festus Agrovet Management System</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
<script>
function validateForm()
{


var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	for(i=0;i<str.length;i++)
	{
	
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}


var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	for(i=0;i<str.length;i++)
	{
	
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>
 <style>
<style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
 </style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"></a> festus Agrovet Management System</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="admin.php">Dashboard</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_manager.php">Manager</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
		</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Manager</h4> 
<hr/>	
    <div class="tabbed_area">  

      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View User</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add User</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
			<?php echo $message;
			  echo $message1;
			  
	
        include_once('connect_db.php');

     
		
        $result = mysql_query("SELECT * FROM manager") 
                or die(mysql_error());
				
					    
      
        
        echo "<table border='1' cellpadding='5' align='center'>";
        echo "<tr> <th>ID</th><th>Firstname </th> <th>Lastname </th> <th>Username </th><th>Update </th><th>Delete</th></tr>";

     
        while($row = mysql_fetch_array( $result )) {
                
     
                echo "<tr>";
                
                echo '<td>' . $row['manager_id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				?>
				<td><a href="update_manager.php?username=<?php echo $row['username']?>"><img src="images/update-icon.png" width="35" height="35" border="0" /></a></td>
				<td><a href="delete_manager.php?manager_id=<?php echo $row['manager_id']?>"><img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
				<?php
		 } 

        echo "</table>";
?> 
        </div>  
        <div id="content_2" class="content">  
		      
		<?php echo $message;
			  echo $message1;
			  ?>
		<form name="form1" onsubmit="return validateForm(this);" action="admin_manager.php" method="post" >
			<table width="220" height="106" border="0" >	
				<tr><td align="center"><input name="first_name" type="text" style="width:170px" placeholder="First Name" required="required" id="first_name" /></td></tr>
				<tr><td align="center"><input name="last_name" type="text" style="width:170px" placeholder="Last Name" required="required" id="last_name" /></td></tr>
				<tr><td align="center"><input name="staff_id" type="text" style="width:170px" placeholder="Staff ID" required="required" id="staff_id"/></td></tr>  
				<tr><td align="center"><input name="postal_address" type="text" style="width:170px" placeholder="Address" required="required" id="postal_address" /></td></tr>  
				<tr><td align="center"><input name="phone" type="text" style="width:170px"placeholder="Phone"  required="required" id="phone" /></td></tr>  
				<tr><td align="center"><input name="email" type="email" style="width:170px" placeholder="Email" required="required" id="email" /></td></tr>   
				<tr><td align="center"><input name="username" type="text" style="width:170px" placeholder="Username" required="required" id="username" /></td></tr>
				<tr><td align="center"><input name="password" type="password" style="width:170px" placeholder="Password" required="required" id="password"/></td></tr>
				<tr><td align="right"><input name="submit" type="submit" value="Submit"/></td></tr>
            </table>
		</form>
        </div>   
        
      
    </div>  
  
</div>
 
</div>
<div id="footer" align="Center"> festus Agrovet Management System 2017. </div>
</div>
</body>
</html>
