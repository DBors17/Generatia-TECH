<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bors Dorin</title>
</head>
<body>
    <?php const initiale = 'DB'; ?>
    <?php
    $navbar = [
        [
            'link' => 'index.php',
            'name' => 'Home'
        ],
        [
            'link' => 'movies.php',
            'name' => 'Movies'
        ],
        [
            'link' => 'contact.php',
            'name' => 'Contact'
        ]
    ]; 
    if(isset($_COOKIE['fav_movies'])) {
        $fav_movies = json_decode($_COOKIE['fav_movies'], true);
        if(!empty($fav_movies)){
            $navbar[] =  [
                'link' => 'movies.php?page=favorites',
                'name' => 'Favorite'
            ];
        }
    }
    ?>
    <?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo initiale; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($navbar as $nav) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($curPageName == $nav['link']) {
                                                    echo 'active';
                                                } ?>" href="<?php echo $nav['link']; ?>"><?php echo $nav['name']; ?></a>
                        </li>
                    <?php }?>
                    <?php $genres = json_decode(file_get_contents('./assets/movies-list-db.json'), true)['genres']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Genres</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($genres as $gen){ ?>
                                <a class="dropdown-item" href="movies.php?genre=<?php echo $gen ?>"><?php echo $gen ?></a>
                            <?php }?>
                        </div>
                    </li>
                </ul>
                <?php include 'search-form.php' ?>
            </div>
        </div>
    </nav>
    <?php if (!($curPageName == 'index.php') and !($curPageName == 'contact.php')) {
        $movies =  json_decode(file_get_contents('assets/movies-list-db.json'), true)['movies']; }?>
    <?php include 'functions.php'; ?>