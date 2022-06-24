<?php

use Firith\Imagine\Http\Controllers\ImagineController;
use Illuminate\Support\Facades\Route;

Route::get('storage/media/resolve/cache/{preset}/{path}', ImagineController::class)
    ->where('path', '.+')
    ->name('firith_imagine');
