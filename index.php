<?php include 'includes/header.php'; ?>
<div class="container">
  <?php $date = new DateTime('', new DateTimeZone('Europe/Bucharest'));
  $string = $date->format('H');
  $int = (int)$string;
  if ($int >= 21 || $int >= 0 && $int < 5) {
    echo "<br>" . 'Night' . "<br><br>";
  }
  if ($int >= 5 && $int < 12) {
    echo "<br>" . 'Good Morning' . "<br><br>";
  }
  if ($int >= 12 && $int < 15) {
    echo "<br>" . 'Afternoon' . "<br><br>";
  }
  if ($int >= 15 && $int < 21) {
    echo "<br>" . 'Evening' . "<br><br>";
  }
  ?>
  <a class="btn btn-primary" href="movies.php" role="button">Movies</a>
</div>
<?php include 'includes/footer.php'; ?>