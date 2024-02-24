<!DOCTYPE html>
<html lang="en">

<?php
include 'comp/header.html';
require_once 'database.php';

// if header data_saved is set, show message
if (isset($_GET['data_saved'])) {
  echo "<div class='message'>Data saved</div>";
}

$sql = "SELECT * FROM genres";
$stmt = $conn->prepare($sql);
$stmt->execute();
$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="main.css">


<body>

  <div id="main">

    <section class="box-admin grid">
      <div class="column-left">
        <form id="form" action="scripts/save-data.php" method="post">
          <fieldset>
            <legend>Bands</legend>
            <div class="form-item">
              <label for="bandnaam">Naam</label>
              <input type="text" id="bandnaam" name="naam" required>
            </div>
            <div class="form-item">
              <label for="genre">Genre</label>
              <select id="genre" name="genre" required>
                <?php
                foreach ($genres as $genre) {
                  echo "<option value='" . $genre['id'] . "'>" . $genre['naam'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-item">
              <label for="date">Date</label>
              <input type="datetime-local" id="date" name="date" required>
            </div>
            <div class="form-item">
              <label for="eventnaam">Event naam</label>
              <input type="text" id="eventnaam" name="eventnaam" required>
            </div>
            <div class="form-item">
              <label for="entreeprijs">Entree prijs in euro</label>
              <input type="number" step=".01" id="entreeprijs" name="entreeprijs" required>
              <input type="submit" value="Submit" class="submitbutton" name="submit">
            </div>
          </fieldset>
        </form>
      </div>

      <div class="column-right">
        <?php
        require_once 'comp/image.html'
        ?>
      </div>
    </section>

  </div>
  <?php
  include 'comp/footer.html';
  ?>

  <style>
    nav {
      background: #dcedff;
    }
  </style>
</body>

</html>