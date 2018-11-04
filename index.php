<?php
/**
 * Created by PhpStorm.
 * User: UnDenya
 * Date: 04.11.2018
 * Time: 13:57
 */

//spl_autoload_register(function ($class) {
//    if (file_exists(__DIR__ . '/src/' . $class . '.php')) {
//        include __DIR__ . '/src/' . $class . '.php';
//    }
//});
namespace Undenya\Images;
require __DIR__."/vendor/autoload.php";

header('Content-Type: image/jpeg');

$image_src = __DIR__."/image/test.jpg";
$image = new Image($image_src);
$crop_img = $image->crop(10, 10, 400, 400);
$image->save(__DIR__."/image/test2.jpg", $crop_img);
$image->viewImage($crop_img);