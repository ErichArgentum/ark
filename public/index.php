<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARK</title>
</head>
<link rel="stylesheet" href="style.css">
<body>



<div class="container">
<form action="insert.php" method="post">
<div class="form-style-6">
    <h1>ARK</h1>
<p>
<input type="text" name="number" id="number_" placeholder="Telefoni Number" />
<p>
<p>
<input type="email" name="email" id="email" placeholder="Emaili Address" />  
<p>

<input type="radio" id="day7" name="day" value="day7">
  <label for="male">7 Päeva</label>


<input type="radio" id="day14" name="day" value="day14">
  <label style="margin" for="male">14 Päeva</label>



<input type="radio" id="day21" name="day" value="day21">
  <label for="male">21 Päeva</label>
  <br>



  <input type="submit" value="Vajuta Siia!">
</form> 



</div>


    
</body>
</html>