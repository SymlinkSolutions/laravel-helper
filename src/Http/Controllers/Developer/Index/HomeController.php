<?php

namespace Symlink\LaravelHelper\Http\Controllers\Developer\Index;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Symlink\LaravelHelper\Services\ConfigIniService;

class HomeController extends Controller {
    // --------------------------------------------------------------------------------------------
    public function showHome() {
        $ini = new ConfigIniService();

        return view('symlink::developer.index.home', [
            "app_name" => env("APP_NAME"),
            "font_primary" => $ini->get('font_primary'),
        ]);

    }
    // --------------------------------------------------------------------------------------------
    public function storeGeneralSettings(Request $request) {
        
        DotenvEditor::setKey("APP_NAME", $request->app_name);
        DotenvEditor::save();

        $ini = new ConfigIniService();
        $ini->update("font_primary", $request->font_primary);

        return redirect()->back()->with(['message' => "Changes Saved"]);
    }
    // --------------------------------------------------------------------------------------------
}