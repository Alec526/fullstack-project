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
        <div class="tablinkbar">
          <button class="tablinks active" onclick="showTab(event, 'bands')">Create bands</button>
          <button class="tablinks" onclick="showTab(event, 'events')">Create events</button>
          <button class="tablinks" onclick="showTab(event, 'band_to_event')">Add band to event</button>
        </div>

        <div id="bands" class="tabcontent" style="display: flex;">
          <form id="form" action="scripts/create-band.php" method="post">
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
                <input type="submit" value="Submit" class="submitbutton" name="submit">
              </div>
            </fieldset>
          </form>
        </div>

        <div id="events" class="tabcontent">
          <form id="form" action="scripts/create-event.php" method="post">
            <fieldset>
              <legend>Events</legend>
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

        <div id="band_to_event" class="tabcontent">
          <form id="form" action="scripts/link-band-to-event.php" method="post">
            <fieldset>
              <legend>Band to event</legend>
              <div class="form-item">
                <label for="event_id">Event</label>
                <select id="event_id" name="event_id" required>
                  <?php
                  $sql = "SELECT * FROM evenementen";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($events as $event) {
                    echo "<option value='" . $event['id'] . "'>" . $event['naam'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-item">
                <label for="band_id">Band</label>
                <select id="band_id" name="band_id" required>
                  <?php
                  $sql = "SELECT * FROM band";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $bands = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($bands as $band) {
                    echo "<option value='" . $band['id'] . "'>" . $band['naam'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <input type="submit" value="Submit" class="submitbutton" name="submit">
            </fieldset>
          </form>
        </div>
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
      background: #844ffe;
    }

    .tablinkbar {
      overflow: hidden;
      border-radius: 5px;
    }

    .tablinkbar button {
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    .tablinkbar button:nth-child(2) {
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
    }

    .tablinkbar button:hover {
      background-color: #ddd;
    }

    .tablinkbar button.active {
      background-color: #ccc;
    }

    .tabcontent {
      display: none;
      padding: 6px 12px;

      width: 100%;

      justify-content: center;
      align-items: center;
    }
  </style>

  <script>
    function showTab(evt, tabName) {
      var i, tabcontent, tablinks;

      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      document.getElementById(tabName).style.display = "flex";
      evt.currentTarget.className += " active";
    }
  </script>
</body>

</html>