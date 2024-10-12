<!DOCTYPE html>
<html lang="en">
<?php include_once './shared/head.php';
include_once './vendor/functions.php';
// auth(2,3);


?>

<body>



  <main>
    <div class="container">
      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>403</h1>
        <h2>The page you are looking for Forbidden </h2>
        <a class="btn" href="<?= base_url('/') ?>">Back to home</a>
        <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">

      </section>

    </div>
  </main><!-- End #main -->


  <?php
  include_once './shared/script.php';
  ?>

</body>

</html>