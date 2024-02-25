<!DOCTYPE html>
<html lang="en">
<?php
include 'comp/header.html';
?>
<link rel="stylesheet" href="main.css">

<script>
  function showPopup(id) {
    console.log("open popup: " + id);
    document.getElementById(id).classList.add('show');
  }

  function closePopup(id) {
    console.log("close popup: " + id);
    document.getElementById(id).classList.remove('show');
  }

  function openTicketsPopup(id) {
    console.log("get tickets for: " + id);
    closePopup(id);
    showPopup('get-tickets-' + id);
  }
</script>

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
      <div class="event-days">
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