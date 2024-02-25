
<div id='<?php echo htmlspecialchars($eventID); ?>' class='popup'>
  <div class='popup-content'>
    <div class="popup-info">
      <span class='close' onclick="">&times;</span>
      <h3><?php echo htmlspecialchars($event['naam']); ?></h3>
      <p>Band: <?php echo htmlspecialchars($band['naam']); ?></p>
      <p>Time: <?php echo htmlspecialchars($event_day) . " - " . htmlspecialchars($tijd); ?></p>
      <p>Price: <?php echo htmlspecialchars($event['prijs']); ?></p>
    </div>
    <button class="button" onclick="openTicketsPopup('<?php echo htmlspecialchars($eventID); ?>')">Get tickets</button>
  </div>
</div>

<div id='get-tickets-<?php echo htmlspecialchars($eventID); ?>' class='popup'>
  <div class='popup-content'>
    <div class="popup-info">
      <!-- popup to get tickets, fill in email, then send ticket to email -->
      <span class='close' onclick="closePopup('get-tickets-<?php echo htmlspecialchars($eventID); ?>')">&times;</span>
      <h3>Get tickets for <?php echo htmlspecialchars($event['naam']); ?></h3>
      <p>Price: <?php echo htmlspecialchars($event['prijs']); ?></p>
    </div>

    <a href="data:image/png;base64,<?php echo createTicket($event); ?>" download="ticket.png" class="button">Download</a>

  </div>
</div>

<style>
  .popup {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
  }

  .popup-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;

    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
  }

  .popup-info {
    text-align: start;
    width: 100%;
  }

  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }

  .button {
    background-color: #844ffe;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }
</style>