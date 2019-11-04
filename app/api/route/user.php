<?php

use think\facade\Route;

Route::post(':version/token/get', 'api/:version.Token/get');
Route::post(':version/token/verify', 'api/:version.Token/verify');
Route::get(':version/user/get', 'api/:version.Token/getId');