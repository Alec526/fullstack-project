<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="website.css">
    <title>Website</title>
</head>
<body>

<div class="header">
    Welcome
</div>

<div id="mySidenav" class="sidenav">
    <li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="news.php">News</a></li>
    <li><a href="flufftext.php">flufftext</a></li>
    <li><a href="contact.php">Contact</a></li>
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</body>
</html>