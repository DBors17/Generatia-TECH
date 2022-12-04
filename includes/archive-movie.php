<div class="card" id="film-<?php echo $movie['id']; ?>">
    <img src="<?php echo $movie['posterUrl']; ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?php echo $movie['title']; ?></h5>
        <p class="card-text"><?php
                                if (strlen($movie['plot']) > 100) {
                                    $str = substr($movie['plot'], 0, 100) . '...';
                                    echo $str;
                                } else {
                                    echo $movie['plot'];
                                }
                                ?></p>
        <a href="movie.php?movie_id=<?php echo $movie['id']; ?>" class="btn btn-primary">Read More</a>
    </div>
</div>