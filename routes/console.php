<?php

use App\Http\Controllers\Cms\GoogleApiController;
use App\Http\Controllers\Crawler\PostCategoryController;
use App\Http\Controllers\Crawler\PostController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('crawler:post', function (PostController $postController) {
    $postController->index();
});
Artisan::command('crawler:updatePostCategory', function (PostCategoryController $postCategoryController) {
    $postCategoryController->index();
});
Artisan::command('cms:autoIndex', function (GoogleApiController $googleApiController) {
    $googleApiController->index();
});
Artisan::command('crawler:updateViewed', function (PostController $postController) {
    $postController->update_viewed();
});
