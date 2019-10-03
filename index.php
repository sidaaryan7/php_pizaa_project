<?php
include('config/db_connect.php');

// writing query for getting pizaa from database

$sql='SELECT title,ingredinat,id FROM pizza ORDER BY created_at';

//make query and get results
$result=mysqli_query($conn,$sql);

//fetch the resulting row as  and array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);

//free the result variable from the memory
mysqli_free_result($result);

//closing the connetion to the SQLiteDatabase
mysqli_close($conn);

//print_r(explode(',',$pizzas[0]['ingredinat']));



 ?>





<html>

<?php include('templates/header.php');?>

<h4  class="center grey-text" >PIZZAS!</h4>

<div class="container">
  <div class="row">
<?php
foreach ($pizzas as $pizza): ?>

<div class="col s6 md3">
  <div class="card z-depth-0">
<img src="img/download.svg" class="pizza" alt="">

    <div class="card-content center">
<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
<ul>
  <?php foreach (explode(',',$pizza['ingredinat'])as $ing) :?>
<li> <?php echo htmlspecialchars($ing); ?> </li>

<?php endforeach; ?>
</ul>

    </div>
<div class="card-action right-align">
  <a class="brand-text"  href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>

</div>
  </div>

</div>

<?php endforeach; ?>


  </div>

</div>

<?php include('templates/footer.php');?>


</html>
