<!DOCTYPE html>
<html lang="en">
<?php
include 'comp/header.html';
?>
<link rel="stylesheet" href="main.css">

<body>
  <div id="wrapper">
    <section class="box grid">

      <div class="column-left">
        <h1>Casus Cafe Programma</h1>
        <p>Welkom! Bekijk onze events:</p>
      </div>

      <div class="column-right">
        <?php
        require_once 'comp/image.html'
        ?>
      </div>

    </section>

    <section class="box">
      <div class="events">
        <?php
        require_once 'scripts/get-event.php';
        ?>
      </div>
  </div>
  </section>
  </div>
  <?php
  include 'comp/footer.html';
  ?>
  
</body>

</html>