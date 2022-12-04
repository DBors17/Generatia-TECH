<?php include 'includes/header.php'; ?>
<div class="container">
    <div class="container px-4">
        <div class="row gx-5">
            <?php
            if (isset($_GET['genre']) && $_GET['genre']) { ?>
                <h1><?php echo $_GET['genre']; ?> Movies</h1>
                <?php
                foreach ($movies as $movie) {
                    foreach ($movie['genres'] as $mov_gen) {
                        if ($mov_gen === $_GET['genre']) { ?>
                            <div class="col-4 pb-3">
                                <div class="p-3 border bg-light">
                                    <?php include 'includes/archive-movie.php'; ?>
                                </div>
                            </div>
                <?php }
                    }
                }
            } else { ?>
                <h1>Movies</h1>
                <?php
                foreach ($movies as $key => $movie) { ?>
                    <div class="col-4 pb-3">
                        <div class="p-3 border bg-light">
                            <?php include 'includes/archive-movie.php'; ?>
                        </div>
                    </div>
            <?php
                }
            } ?>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>