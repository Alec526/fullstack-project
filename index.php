<!DOCTYPE html>
<html lang="en">
<?php
include 'comp/header.html';
?>
<link rel="stylesheet" href="homestyle.css">

<body>

  <div id="wrapper">
    <div id="main">

      <section class="box">
        <div class="box-welkom">
          <div class="column-left">
            <h1>Casus Cafe Programma</h1>
            <p>Welkom! Bekijk onze events:</p>
          </div>
          <div class="column-right">
            <img src="./images/casuscafeflyer.png" alt="logo van casus cafe" class="box-image">
          </div>
        </div>
      </section>

      <section class="box">
        <div class="box-container events">
          <?php
            require_once 'scripts/get-event.php';
          ?>
            </div>
        </div>
      </section>
    </div>
  </div>

  <?php
  include 'comp/footer.html';
  ?>

</body>

</html>