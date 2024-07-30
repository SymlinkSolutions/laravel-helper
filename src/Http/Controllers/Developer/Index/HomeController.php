<?php

namespace Symlink\LaravelHelper\Http\Controllers\Developer\Index;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class HomeController extends Controller {
    // --------------------------------------------------------------------------------------------
    public function showHome() {

        return view('symlink::developer.index.home', [
            "app_name" => env("APP_NAME"),
        ]);

    }
    // --------------------------------------------------------------------------------------------
    public function storeGeneralSettings(Request $request) {
        
        DotenvEditor::setKey("APP_NAME", $request->app_name);
        DotenvEditor::save();

        return redirect()->back()->with(['message' => "Changes Saved"]);
    }
    // --------------------------------------------------------------------------------------------
}