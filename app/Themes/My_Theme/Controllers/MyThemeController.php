<?php
namespace App\Themes\My_Theme\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class MyThemeController extends Controller {
    public function index() {
        return View::make('Theme::welcome')->with('body', ['message' => 'Hello, world!']);
    }
}
