<?php

include('config/db_connect.php');

$email=$Title=$Ingrediants='';

$error=array('email'=>'','Title'=>'','Ingrediants'=>'');

//checking email

if(empty($_POST['email'])){
	$error['email']="u gotta fill it";
}else{
	$email=$_POST['email'];
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	$error['email']="not a valid email"."<br/>";
}
}
//cheking title

if(empty($_POST['Title'])){
	$error['Title']="u gotta select title"."<br/>";
}else{
	$Title=$_POST['Title'];
	if(!preg_match('/^[a-zA-Z\s]+$/',$Title)){
	$error['Title']='title only contains lettesr and spaces only';
                                              }
      }

//checking ingrediants

if(empty($_POST['Ingrediants'])){
	$error['Ingrediants']="u gotta select ingrediants"."<br/>";
}else{
   $Ingrediants=$_POST['Ingrediants'];
   if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$Ingrediants)){

	$error['Ingrediants']= "ingrediants must be comma seperated";
}
}


if(array_filter($error)){
	//echo"error in the from";
}else{

  $email=mysqli_real_escape_string($conn,$_POST['email']);
  $Title=mysqli_real_escape_string($conn,$_POST['Title']);
  $Ingrediants=mysqli_real_escape_string($conn,$_POST['Ingrediants']);

  //creat sql
  $sql="INSERT INTO pizza(title,email,ingredinat) VALUES('$Title','$email','$Ingrediants')";

  //save to db and checcking
  if(mysqli_query($conn,$sql)){
    //succes
    header('location:index.php');
  }else {
    //error
echo "query error  :".mysqli_error($conn) ;
  }


}

?>



<!DOCTYPE html>
<html>

<?php include('templates/header.php');?>


<section class="container grey-text">

	<h4 class="center">Add a pizaaa</h4>
	<form class="white"  action="add.php" method="POST">
		<label>your email:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
		<div class="red-text"> <?php  echo $error['email']; ?>  </div>
		<label>Pizza Title:</label>
		<input type="text" name="Title" value="<?php echo htmlspecialchars($Title); ?>">
		<div class="red-text"> <?php  echo $error['Title']; ?>  </div>
		<label>Ingrediants(comma seperated):</label>
		<input type="text" name="Ingrediants" value="<?php echo htmlspecialchars($Ingrediants); ?>">
		<div class="red-text"> <?php  echo $error['Ingrediants']; ?>  </div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>

	</form>
</section>

<?php include('templates/footer.php');?>


</html>
