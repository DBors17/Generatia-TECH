<?php
function runtime_prettier(int $minute) {
    $ore = 0;
while($minute>=60){
    $ore++;
    $minute = $minute - 60;
}
echo $ore.' hours '.$minute.' minutes';
}

function check_old_movie(int $an){
  $current_year = date('Y');
    if(($current_year-$an)>40){
        return $current_year-$an; 
    }
    else{
        return false;
    }
}

function find_movie_by_id($item){
    if(!isset($_GET['movie_id'])) return false;
      if($item['id'] === intval($_GET['movie_id'])){
        return true;
      }else{
        return false;
      }
  }

function find_movie_by_title($item){
  if(stripos($item['title'],$_GET['Search']) === false){
    return false;
  }else{
    return true;
  }
  }

function check_poster($img_url){
if(@getimagesize($img_url['posterUrl'])){
  return true;
  }else{
  return false;
  }
}

function db_connect($host = "localhost", $username = "php-user" , $password = "php-password", $dbname = "php-proiect"){
  return mysqli_connect($host, $username , $password , $dbname);
}