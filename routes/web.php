<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::post('/upload', function(Request $request) {
	$path = $request->file('file')->store('/');
	$ffmpeg = \FFMpeg\FFMpeg::create();
	$video = $ffmpeg->open('../storage/app/'.$path);
	$video
		->filters()
		->resize(new \FFMpeg\Coordinate\Dimension(320, 240))
		->synchronize();
	
	$video
		->save(new \FFMpeg\Format\Video\WebM(), '../storage/app/'.$path.'.webm');
	Storage::delete($path);
	return "success";
});
