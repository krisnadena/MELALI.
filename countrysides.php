<?php include 'connect.php'; ?>
<?php
$sql = "SELECT * FROM Rekomendasi WHERE category='country sides area'";
$result = $conn->query($sql);




?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>county sides area</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<section class="header">

   <a href="home.php" class="logo">MELALI.</a>

   <nav class="navbar">
      <a href="home.php">home</a>
      <a href="about.php">about</a>
      <a href="chatbot.php">chatbot</a>
      <!--<a href="package.php">package</a>-->
      <a href="book.php">book</a>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<section class="home-packages">

<h1 class="heading-title"> Country Sides Area </h1>

<div class="box-container">
   <?php
   
   foreach($result as $row){
      if($row["price"]==0){
         $price="FREE";
   
      }
      else{
         $price=$row["price"];
      }
    echo '  <div class="box">
               <div class="image">
                  <img src="'.$row["link_images"].'" alt="">
               </div>
               <div class="content">
                  <h3>'.$row["name"].'</h3>
                  <p1><span style="text-align: left">Rp. </span>'.$price.' </p1>
                  <p>'.$row["rating"].' <i class="fas fa-star"></i></p>
                  <a href="'.$row["link_gmaps"].'" class="btn">location</a>
               </div>

            </div>'; 
   }
   ?>
</div>

<div class="load-more"> <a href="package.php" class="btn">load more</a> </div>

</section>

</body>
</html>