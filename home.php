<?php include 'connect.php'; ?>
<?php
$sql = "SELECT * from rekomendasi";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
<section class='melayang'>
<nav>
      <?php
      include 'card.php';
      ?>
   </nav>
</section>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(images/pura2.jpg) no-repeat">
            <div class="content">
               <span>wellcome to bali</span>
               <h3>travel arround the paradise</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/sawah1.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>discover the new places</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/pulau-bali.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>make your tour worthwhile</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>
         
      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- home section ends -->

<!-- services section starts  -->

<section class="services">

   <h1 class="heading-title"> featured destinations </h1>

   <div class="box-container">

      <div class="box">
         <a href="?category=beach">
            <a href="beach.php" class="btn">beach <img src="images/icon-bc.png" alt=""></a>
            <h3></h3>
         </a>
      </div>

      <div class="box">
         <a href="?category=nature">
            <a href="nature.php" class="btn">nature <img src="images/icon-1.png" alt=""></a>
            <h3></h3>
         </a>
      </div>

      <div class="box">
         <a href="?category=country sides area">
            <a href="countrysides.php" class="btn">country sides area <img src="images/icon-2.png" alt=""></a>    
            <h3></h3>
         </a>
      </div>

      <div class="box">
         <a href="?category=town and cities">
            <a href="town_and_city.php" class="btn">town and cities <img src="images/icon-town.png" alt=""></a>
            <h3></h3>
         </a>
      </div>

      <div class="box">
         <a href="?category=heritage and culture">
            <a href="heritage.php" class="btn">heritage <img src="images/icon-6.png" alt=""></a>
            <h3></h3>
         </a>
      </div>



   </div>

</section>

<!-- services section ends -->

<!-- home about section starts  -->

<section class="home-about">

   <div class="image">
      <img src="images/as.jpg" alt="">
   </div>

   <div class="content">
      <h3>about us</h3>
      <p>We are five young and enthusiastic students from Udayana University who really care about the state 
         of tourism on the island of Bali. With a digital approach and the knowledge we gained while studying at Obit Future Academy, 
         a website with AI recommendations (collaborative filtering) was formed along with location data, 
         prices and ratings for the place. we hope this will have a tremendous impact on our society.</p>
      <a href="about.php" class="btn">read more</a>
   </div>

</section>

<!-- home about section ends -->

<!-- home packages section starts  -->

<section class="home-packages">

   <h1 class="heading-title"> our packages </h1>

   <div class="box-container">
      <?php
      foreach($result as $row){
         if($row["price"]==0){
            $price="FREE";
         }
         else{
            $price=$row["price"];
         }
       echo '<div class="box">
                  <div class="image">
                     <img src="'.$row["link_images"].'" alt="">
                  </div>
                  <div class="content">
                     <h3>'.$row["name"].'</h3>
                     <p1><span style="text-align: left">Rp. </span>'.$price.' </p1>
                     <p>'.$row["rating"].' <i class="fas fa-star"></i></p>
                     <a href="'.$row["link_gmaps"].'" class="btn">location</a>
                     <a href="book.php" class="btn">Book Now</a>
                  </div>
               </div>'; 
      }
      ?>
   </div>

   <div class="load-more"> <a href="package.php" class="btn">load more</a> </div>

</section>

<!-- home packages section ends -->

<!-- home offer section starts  -->

<section class="home-offer">
   <div class="content">
      <h3>upto 50% off</h3>
      <p>JUST FOR YOU</p>
      <a href="book.php" class="btn">book now</a>
   </div>
</section>

<!-- home offer section ends -->

















<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i> book</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +62 838-5138-7027 </a>
         <a href="#"> <i class="fas fa-phone"></i> +62 859-7787-9431 </a>
         <a href="#"> <i class="fas fa-envelope"></i> melalibali@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> Badung, Bali - 80361 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <div class="credit"> created by <span>MELALI.</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->









<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>