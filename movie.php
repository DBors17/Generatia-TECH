<?php
ob_start();
?>
<?php include 'includes/header.php'; ?>
<div class="container">
  <?php $movie_id = $_GET['movie_id'];
  $movies_filtered = array_filter($movies, 'find_movie_by_id');
  if (isset($movies_filtered) && $movies_filtered) {
    $movie = reset($movies_filtered);
  } ?>
  <?php if (isset($movie) && $movie) { ?>
    <div class="row justify-content-between">
      <div class="col-auto">
        <div class="h1">
          <?php echo $movie['title']; ?>
        </div>
      </div>
      <div class="col-auto text-end">
        <?php
        $fav_movies = array();
        $fav_stats =  json_decode(file_get_contents('assets/movie-favorites.json'), true);
        if (!$fav_stats) $fav_stats = array();
        if (isset($_COOKIE['fav_movies'])) {
          $fav_movies = json_decode($_COOKIE['fav_movies'], true);
        }
        if (isset($_POST['fav'])) {
          if ($_POST['fav'] === '1' && !in_array($_GET['movie_id'], $fav_movies)) {
            $fav_movies[] = $_GET['movie_id'];
            if (array_key_exists($_GET['movie_id'], $fav_stats)) {
              $fav_stats[$_GET['movie_id']]++;
            } else {
              $fav_stats[$_GET['movie_id']] = 1;
            }
          } elseif ($_POST['fav'] === '0' && in_array($_GET['movie_id'], $fav_movies)) {
            if (($key = array_search($_GET['movie_id'], $fav_movies)) !== false) {
              unset($fav_movies[$key]);
              if ($fav_stats[$_GET['movie_id']] > 0) $fav_stats[$_GET['movie_id']]--;
            }
          }
          setcookie("fav_movies", json_encode($fav_movies), time() + (365 * 24 * 60 * 60));
          file_put_contents('assets/movie-favorites.json', json_encode($fav_stats));
          header('Location: '. $_SERVER['REQUEST_URI']);
        }
        ?>
        <form method="POST" action="">
          <input type="hidden" name="fav" value="<?php if (in_array($_GET['movie_id'], $fav_movies)) {
                                                    echo '0';
                                                  } else {
                                                    echo '1';
                                                  } ?>">
          <button class="btn position-relative <?php if (in_array($_GET['movie_id'], $fav_movies)) {
                                                echo 'btn-light mt-2';
                                              } else {
                                                echo 'btn-danger mt-2';
                                              } ?>" type="submit">
            <?php if (in_array($_GET['movie_id'], $fav_movies)) {
              echo "Sterge din favorite";
            } else {
              echo 'Adauga la favorite';
            } ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo $current_movie_fav_stats = (isset($fav_stats[$_GET['movie_id']])) ? $fav_stats[$_GET['movie_id']] : 0; ?>
              <span class="visually-hidden"><?php echo $current_movie_fav_stats ?></span>
            </span>
          </button>
        </form>
      </div>
    </div>
    <?php  
    ?>
    <div class="card mb-3 mt-2">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo $movie['posterUrl']; ?>" class="img-fluid rounded-start" alt="<?php echo $movie['title']; ?>">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $movie['year']; ?></h5>
            <?php if (check_old_movie($movie['year'])) { ?>
              <h6 class="text-muted"> Old movie: <?php echo check_old_movie($movie['year']); ?> years</h6>
            <?php } ?>
            <p class="card-text"><?php echo $movie['plot']; ?></p>
            <p>Directed By : <b><?php echo $movie['director']; ?></b></p>
            <p>Runtime : <b><?php runtime_prettier($movie['runtime']) ?></b></p>
            <p>Genres : <b><?php echo implode(", ", $movie['genres']); ?></b></p>
            <h3>Cast: </h3>
            <?php
            echo $li = '<ul><li>' . str_replace(', ', '</li><li>', $movie['actors']) . '</li></ul>';
            ?>
          </div>
          <?php include_once('./includes/movie-reviews.php'); ?> 
        </div>
      </div>
    <?php } else { ?>
      <h1>Movie page</h1>
      <p>Error! No movie.</p>
      <a href="movies.php" class="btn btn-primary"> Back to all movies</a>
    <?php } ?>
    </div>
</div>
    <?php include 'includes/footer.php'; ?>
    <?php
    ob_end_flush();
    ?>