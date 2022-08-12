<?php
session_start();
require_once 'Classes/Player.php';
require_once 'Classes/Battle.php';
require_once 'Classes/AssignValues.php';
require_once 'Classes/Loggers/CsvLogger.php';

use Classes\AssignValues;
use Classes\Battle;
use Classes\Player;
use Classes\Loggers\GameLogger;
use Classes\Loggers\CsvLogger;

if(!empty($_POST)){
    $postValues = new AssignValues($_POST);
    $postValues->validation();

    $postForPlayer1 = $postValues->fillArray()->getUser1();
    $postForPlayer2 = $postValues->fillArray()->getUser2();

    if(!empty($postForPlayer1) && !empty($postForPlayer2)){
        $player_1 = new Player($postForPlayer1, 'Player_1');
        $player_2 = new Player($postForPlayer2, 'Player_2');

        $battle = new Battle($player_1, $player_2);

        /** @var GameLogger $logger */
        $logger = $battle->fight();
        $logText = $logger::getGameLog();

        CsvLogger::writeToFile($logText);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Battle</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mx-auto">
      <a href="/" class="nav-item nav-link px-3" style="font-size: medium">Home</a>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <form method="post" action="/">
    <div class="row">
      <div class="col-sm">
        Player 1
        <div class="form-group">
          <label for="warlock_1">Warlock</label>
          <input type="number" name="Warlock_1" class="form-control <?= isset($_SESSION['Warlock_1']) ? 'is-invalid' : '';?>" id="warlock_1" placeholder="strength 10">
          <?php
          if (isset($_SESSION['Warlock_1'])) {
          ?>
            <small id="warlock_1Help" class="form-text text-danger"><?=$_SESSION['Warlock_1'] ??= '';?></small>
          <?php
          }
          ?>
          <small id="warlock_1Help" class="form-text text-muted">Warlock has 50 health, damage from 0 to 10</small>
        </div>
        <div class="form-group">
          <label for="magician_1">Magician</label>
          <input type="number" name="Magician_1" class="form-control <?= isset($_SESSION['Magician_1']) ? 'is-invalid' : '';?>" id="magician_1" placeholder="strength 20">
            <?php
            if (isset($_SESSION['Magician_1'])) {
                ?>
                <small id="warlock_1Help" class="form-text text-danger"><?=$_SESSION['Magician_1'] ??= '';?></small>
                <?php
            }
            ?>
            <small id="magician_1Help" class="form-text text-muted">Magician has 100 health, damage from 10 to 20</small>
        </div>
          <div class="form-group">
              <label for="paladin_1">Paladin</label>
              <input type="number" name="Paladin_1" class="form-control <?= isset($_SESSION['Paladin_1']) ? 'is-invalid' : '';?>" id="paladin_1" placeholder="strength 30">
              <?php
              if (isset($_SESSION['Paladin_1'])) {
                  ?>
                  <small id="paladin_1Help" class="form-text text-danger"><?=$_SESSION['Paladin_1'] ??= '';?></small>
                  <?php
              }
              ?>
              <small id="warlock_1Help" class="form-text text-muted">Paladin has 150 health, damage from 20 to 25</small>
          </div>
      </div>
      <div class="col-sm">
        Player 2
        <div class="form-group">
          <label for="warlock_2">Warlock</label>
          <input type="number" name="Warlock_2" class="form-control <?= isset($_SESSION['Warlock_2']) ? 'is-invalid' : '';?>" id="warlock_2" placeholder="strength 10">
            <?php
            if (isset($_SESSION['Warlock_2'])) {
                ?>
                <small id="warlock_1Help" class="form-text text-danger"><?=$_SESSION['Warlock_2'] ??= '';?></small>
                <?php
            }
            ?>
            <small id="warlock_2Help" class="form-text text-muted">Warlock has 50 health, damage from 0 to 10</small>
        </div>
        <div class="form-group">
          <label for="magician_2">Magician</label>
          <input type="number" name="Magician_2" class="form-control <?= isset($_SESSION['Magician_2']) ? 'is-invalid' : '';?>" id="magician_2" placeholder="strength 20">
            <?php
            if (isset($_SESSION['Magician_2'])) {
                ?>
                <small id="warlock_1Help" class="form-text text-danger"><?=$_SESSION['Magician_2'] ??= '';?></small>
                <?php
            }
            ?>
            <small id="magician_2Help" class="form-text text-muted">Magician has 100 health, damage from 10 to 20</small>
        </div>
          <div class="form-group">
              <label for="paladin_2">Paladin</label>
              <input type="number" name="Paladin_2" class="form-control <?= isset($_SESSION['Paladin_2']) ? 'is-invalid' : '';?>" id="paladin_2" placeholder="strength 30">
              <?php
              if (isset($_SESSION['Paladin_2'])) {
                  ?>
                  <small id="paladin_2Help" class="form-text text-danger"><?=$_SESSION['Paladin_2'] ??= '';?></small>
                  <?php
              }
              ?>
              <small id="warlock_1Help" class="form-text text-muted">Paladin has 150 health, damage from 20 to 25</small>
          </div>
      </div>
    </div>
      <?php
        if(isset($_SESSION['twoCommands'])) echo '<div class="text-danger">Two teams must participate in the battle</div>';
      ?>
    <button type="submit" id="submitBattle" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='Sending…'; ">Fight</button>

  </form>
</div>

<div class="container mt-3 text-center">

    <?php
    if(!empty($_POST) && empty($_SESSION) && !empty($postForPlayer1) && !empty($postForPlayer2)) {
        ?>
            <h2>Результат боя</h2>
        <?php
            echo $logText;
        ?>
            <div class="mt-3 mb-3">
                <a href='<?= CsvLogger::getFileName() ?>' download="">
                    <button type="button" class="btn btn-success">Download CSV File from fight</button>
                </a>
            </div>
        <?php
    }
    ?>
</div>

</body>
</html>
<?php
session_unset();
?>