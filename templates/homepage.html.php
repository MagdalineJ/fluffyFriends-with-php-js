<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="stylesheet/style.css">

  <title><?= htmlspecialchars($title ?? 'Fluffy Friends') ?></title>
</head>
<body>

<header>
<nav class="navbar navbar-expand-md wave-nav fixed-top">
  <div class="container-fluid">

    <a class="navbar-brand text-success" href="index.php" id="brand">
      Fluffy Friends <i class="fa-solid fa-paw"></i>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link active" href="petlist.php">New Friends</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="nav-about" href="#about">About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#accordionExample">FAQ</a>
        </li>

        <!-- DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Others
          </a>

          <ul class="dropdown-menu">

            <li>
              <a class="dropdown-item" href="reviews.php">Reviews</a>
            </li>

            <li>
              <a class="dropdown-item" href="#" id="privacy-link">Privacy Terms</a>
            </li>

            <li>
              <a class="dropdown-item" href="#contact">Contact Us</a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <?php if (!empty($isLoggedIn)): ?>
              <li id="log-in" class="dropdown-item-text">
                Hi, <?= htmlspecialchars($_SESSION['user']['name']) ?>
              </li>
              <li>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </li>
            <?php else: ?>
              <li id="log-in">
                <a class="dropdown-item" href="login.php">Login</a>
              </li>
              <li>
                <a class="dropdown-item" href="signup.php">Sign up</a>
              </li>
            <?php endif; ?>

          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
</header>

<main>

  <!-- PAGE CONTENT -->
  <div id="petList"><?= $output ?? '' ?></div>

<?php if (($layout ?? 'site') !== 'auth'): ?>

<!------------------------------------------------------------------->
<div id="about" style="<?= !empty($hideAbout) ? 'display:none;' : '' ?>">
<div class="row" >

<div class="col-md-6 "> 
  <!-- carousel -->
  <section id="carousel"> 
    <div id="carouselExampleFade" class="carousel slide carousel-fade">
      
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="pic/carousel/cats.jpg" class="d-block w-100" alt="group of cats image">
        </div>

        <div class="carousel-item">
          <img src="pic/carousel/dogs.jpg" class="d-block w-100" alt="group of dogs">
        </div>

        <div class="carousel-item">
          <img src="pic/carousel/catNdog.jpg" class="d-block w-100" alt="both cats and dogs in image">
        </div>

        <div class="carousel-item">
          <img src="pic/carousel/rabbits.jpg" class="d-block w-100" alt="group of rabbits in image">
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

    </div>
  </section>
</div>
    <div class="col-6 col-md-4 about-us border border-1 shodow-lg bg-sucess rounded" >
      <h2>About Us</h2>
      <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
    </div>
</div>
</div>


<!------------------------------FAQ------------------------------------->
<section >
  <h2 class="m-auto mt-5 text-center text-success"> Frequenty Asked Questions</h2>
<div class="accordion mb-4" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        How can I reach for a pet that I would like to adopt?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Either contact us through the menu/bottom link or request for a quote</strong> We will then send details in your provided email. 
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        How to view Pricing? 
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>In order to view the prpice list, select the chosen pet in the cart and request for a quote.</strong> We will thereby describe all the details and prices accordingly.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        What if my pet gets sick after we get home?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>We will be always there through helpline and vet appointments</strong> We will be providing all the necessary guidelines after you adopt a pet.  
      </div>
    </div>
  </div>
  <div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#collapseFour"
      aria-expanded="false"
      aria-controls="collapseFour">
      Do you do deliveries?
    </button>
  </h2>

  <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      <strong>Unfortunately, we don't do deliveries.</strong>
      After you contact us, to get a quotation or any other inquiry, we would send you all details of pricing and local shop address of the following pet. We believe in in-person communication regarding our friends diet and health as well as your satisfaction on getting a new friend.
    </div>
  </div>
  </div>

</div>
</section>


<!------------------------------------------------------------------->
  <!-- footer -->
  <div class="footer">
  <div class="row others ">
    <div class="col-12 col-md-6 others p-5 ms-2"> 
    <h2> <a href="reviews.php" class="text-decoration-none text-success ">Reviews</a> </h2>

<!------------------------------------------------------------------->


    <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal" id="t&c">
      <h2 class="text-success">Privacy Terms</h2>
    </button>

<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 bg-warning-subtle rounded p-3 " id="exampleModalLabel">Privacy Terms</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Agree & Close</button>
      </div>
    </div>
  </div>
  </div>
<!------------------------------------------------------------------->

      <!-- <h2 id="contact">Contact Us <i class="fa-regular fa-envelope"></i></h2> -->
    <h2 id="contact">
    <a
    href="mailto:<?= htmlspecialchars($_ENV['MAIL_USER'], ENT_QUOTES, 'UTF-8') ?>?subject=Fluffy%20Friends%20Enquiry"
    class="text-decoration-none text-success"
    >
    Contact Us <i class="fa-regular fa-envelope"></i>
    </a>
    </h2>
      
        
    </div>

<!------------------------------------------------------------------->

    <div class="col-4" id="other_img"> 
      <img src="pic/vecteezy_cartoon.png" alt=" vector animated iamge of cat, dog and rabbit">
    </div>

    <footer class="p-5"> <p><i class="fa-regular fa-copyright"></i> Fluffy Friends, 2025. All rights reserved.</p> </i></footer>
</div>
</div>
    
<!------------------------- wrapping everything for log in/ sign up page------------------------------------------>

<?php endif; ?>
     
  </main>

 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/37fd7c136e.js" crossorigin="anonymous"></script>
<script src="script/app.js"></script>



</body>


</html>