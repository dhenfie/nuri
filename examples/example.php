<?php

/**
 * contoh penggunaan Nuri sebagai sistem template
 */

 use Dhenfie\Nuri\Nuri;

 require '../vendor/autoload.php';


 // buat object theme dari class Nuri
 $theme = new Nuri(__DIR__);
 $theme->render('home');
