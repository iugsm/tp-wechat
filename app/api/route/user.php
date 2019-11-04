<?php

use think\facade\Route;

Route::get(':version/user', 'api/:version.User/index');