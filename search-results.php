<?php include 'includes/header.php'; ?>
<div class="container">
    <div class="container px-4">
        <div class="row gx-5">
            <?php

            $search = $_GET['Search'];
            if (isset($search) && strlen($search) >= 3) { ?>
                <h1> Search results for:<strong><?php echo $search; ?></strong></h1>
                <?php
                $filtered_movies = array_filter($movies, 'find_movie_by_title');
                if (count($filtered_movies) === 0) { ?>
                    <h1>No results!</h1>
                    <?php include('search-form.php');
                } else {
                    foreach ($filtered_movies as $movie) { ?>
                        <div class="col-4 pb-3">
                            <div class="p-3 border bg-light">
                                <?php include 'includes/archive-movie.php'; ?>
                            </div>
                        </div>
                <?php }
                }
            } elseif (isset($search) && strlen($search) < 3) { ?>
                <h1>Invalid search</h1>
                <p>Too short search query.</p>
            <?php include('search-form.php');
            } else { ?>
                <h1>Invalid search</h1>
                <p>Try something else!</p>
            <?php include('search-form.php');
            } ?>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>