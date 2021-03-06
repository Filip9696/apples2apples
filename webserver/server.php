<?php
ini_set('display_errors', 'Off');
$ip = $_GET["ip"];
$id = $_GET["id"];
if (!isset($id) or $id == "") {
  if (!isset($ip) or $ip == "") {
    $id = "No ip specified in url!";
  } else {
    $conn = new mysqli('filipkin.com', 'a2a', 'password', 'a2a');
    $sql = "SELECT * FROM `ips` WHERE `ip` = '$ip'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id = $row["code"];
      }
    } else {
      $idisunique = false;
      while (!$idisunique) {
        $id = dechex(rand(0, 4095));
        $sql = "SELECT * FROM `ips` WHERE `code` = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
          $idisunique = true;
          $sql = "INSERT INTO `ips` (`code`, `ip`) VALUES ('$id', '$ip')";
          $result = $conn->query($sql);
        }
      }
    }
  }
} else {
  if (!isset($ip) or $ip == "") {
    $id = "No ip specified in url!";
  } else {
    $conn = new mysqli('filipkin.com', 'a2a', 'password', 'a2a');
    $sql = "SELECT * FROM `ips` WHERE `code` = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $id = $id;
    } else {
      $id = "ID does not exist";
    }
  }
}
$conn->close();
?>

<html>
<head>
  <title>Apples2Apples Server</title>
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="css/global.css" rel="stylesheet">
  <link href="css/server.css" rel="stylesheet">
</head>
<body align="center">
  <table id="join" class="center" style="display: block;">
    <tr><td><h1><?php echo $id; ?></h1></td></tr>
    <tr><td><h2>Join from a2a.filipkin.com</h2></td></tr>
    <tr><td><a href="#" class="btn" onClick="closeServer();">Close server</a></td></tr>
    <tr><td><table id="playertable" align="center"><tr><th colspan=2><h3 style="color: white">Player list<h3></th></tr></table><br></td></tr>
    <tr><td id="startGameBtn" style="display:none;"><a href="#" class="btn" onClick="startGame();">Start Game</a></td></tr>
  </table>
  <table id="card" class="center" style="display: none;">
    <tr><td><h4><?php echo $id; ?></h1></td></tr>
    <tr><td><h1>word here</h1></td></tr>
    <tr><td><h2>playername's turn</h2></td></tr>
    <tr><td><h3>Synonym</h3></td></tr>
    <tr><td><h3>Synonym</h3></td></tr>
    <tr><td><h3>Synonym</h3></td></tr>
    <tr><td><h3>Definition</h3></td></tr>
    <tr><td><h3>Example</h3></td></tr>
    <tr><td><a href="#" class="btn" onClick="closeServer();">Close server</a></td></tr>
  </table>
  <table id="leaderboard" class="center" style="display: none;">
    <tr><td><h4><?php echo $id; ?></h1></td></tr>
    <tr><td><h1>Leaderboard</h1></td></tr>
    <tr><td>
    <table id="lb" align="center">
      <tr><th>Place</th><th>Name</th><th>Cards</th></tr>
      <tr><td></td><td>Example person</td><td>9</td></tr>
      <tr><td></td><td>Example 2</td><td>2</td></tr>
      <tr><td></td><td>Example 3</td><td>3</td></tr>
    </table>
    </td></tr>
    <tr><td><a href="#" class="btn" onClick="closeServer();">Close server</a></td></tr>
  </table>
  <script>
  function getIp() {
    return "<?php echo $ip; ?>"
  }
  function getId() {
    return "<?php echo $id; ?>"
  }
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="js/server.js"></script>
</body>
</html>

