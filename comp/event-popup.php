<div id='<?php echo htmlspecialchars($eventID); ?>' class='popup'>
  <div class="popup-head">
    <span class='close' onclick="closePopup('<?php echo htmlspecialchars($eventID); ?>')">&times;</span>
    <h3 class="event-naam"><?php echo htmlspecialchars($event['naam']); ?></h3>
  </div>
  <div class='popup-content'>
    <div class="popup-info">
      <h3 class="tijd"><?php echo date('D d M', strtotime($event_day)) . " - " . htmlspecialchars($tijd); ?></h3>
      <h4 class="band-naam">Line up: <?php echo htmlspecialchars($band['naam']); ?></h4>
    </div>
    <a href="data:image/png;base64,<?php echo createTicket($event); ?>" download="ticket.png" class="button">
      Ticket € <?php echo htmlspecialchars($event['prijs']); ?>
    </a>

    <div class="extra-info">
      <h3>Extra informatie</h3>
      <p><?php echo htmlspecialchars(generageLorumIpsum(5)); ?></p>
    </div>
  </div>
</div>

<script>
  function getRandomImage() {
    var images = [
      452,
      453,
      891
    ];
    var image = images[Math.floor(Math.random() * images.length)];
    return `https://picsum.photos/id/${image}/1000/600.webp`;
  }

  document.getElementById('<?php echo htmlspecialchars($eventID); ?>').getElementsByClassName('popup-head')[0].style.backgroundImage = `url(${getRandomImage()})`;
</script>
