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
<link rel="stylesheet" href="adminstyle.css">


<body>

  <div id="wrapper">
    <div id="main">

      <section class="box">
        <div class="box-container">
          <div id="formdiv1">
            <form id="form1" action="scripts/save-data.php" method="post">
              <fieldset>
                <legend>Bands</legend>

                <label for="bandnaam">Naam</label>
                <input type="text" id="bandnaam" name="naam">

                <label for="genre">Genre</label>
                <select id="genre" name="genre">
                  <?php
                    foreach ($genres as $genre) {
                      echo "<option value='" . $genre['id'] . "'>" . $genre['naam'] . "</option>";
                    }
                  ?>
                </select>

                <label for="date">Date</label>
                <input type="datetime-local" id="date" name="date">

                <label for="eventnaam">Event naam</label>
                <input type="text" id="eventnaam" name="eventnaam">

                <label for="entreeprijs">Entree prijs in euro</label>
                <input type="number" step=".01" id="entreeprijs" name="entreeprijs">

                <input type="submit" value="Submit" class="submitbutton" name="submit">
              </fieldset>
            </form>
          </div>
          <div id="formdiv2">
            <img src="./images/casuscafeflyer.png" alt="logo van casus cafe" class="box-image">
          </div>
        </div>


    </div>
  </div>
  <?php
  include 'comp/footer.html';
  ?>

</body>

</html>