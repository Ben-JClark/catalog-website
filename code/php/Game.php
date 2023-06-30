<?php
class Game{
private $title;
private $genre;
private $release;
private $rating;
private $price;
private $description;
private $image_large;
private $image_small;

function get_title(){
  return $this->title;
}

function get_genre(){
  return $this->genre;
}

function get_release(){
  return $this->release;
}

function get_rating(){
  return $this->rating;
}

function get_price(){
  return $this->price;
}

function get_description(){
  return $this->description;
}

function get_image_large(){
  return $this->image_large;
}

function get_image_small(){
  return $this->image_small;
}

function __construct($title, $genre, $release, $rating, $price, $description, $image_large, $image_small){
  $this->title=$title;
  $this->genre=$genre;
  $this->release=$release;
  $this->rating=$rating;
  $this->price=$price;
  $this->description=$description;
  $this->image_large=$image_large;
  $this->image_small=$image_small;
}
}
?>
