<?php

namespace Symlink\LaravelHelper\Http\Controllers\Developer\Index;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symlink\LaravelHelper\Services\ConfigIniService;
use Symlink\LaravelHelper\Support\Sass\Sass;

class HomeController extends Controller {
    // --------------------------------------------------------------------------------------------
    public function showHome() {

        $ini = new ConfigIniService();

        return view('symlink::developer.index.home', [
            "app_name" => env("APP_NAME"),
            "font_primary" => $ini->get('font_primary'),
            "font_secondary" => $ini->get('font_secondary'),
            "primary_font_family" => $ini->get('primary_font_family'),
            "secondary_font_family" => $ini->get('secondary_font_family'),
        ]);

    }
    // --------------------------------------------------------------------------------------------
    public function updateStyles(){
        $sass_file = resource_path("/sass/generated/generatedBySymlink.scss");
        $sass = new Sass();
        $ini = new ConfigIniService();

        $sass->add([
            ".font-primary" => [
                "font-family" => "'{$ini->get("primary_font_family")}' !important",
            ]
        ]);

        $sass->writeTofile($sass_file);
        

        return redirect()->route('dev.index')->with(['message' => "Styles updated!"]);

    }
    // --------------------------------------------------------------------------------------------
    public function storeGeneralSettings(Request $request) {
        
        DotenvEditor::setKey("APP_NAME", $request->app_name);
        DotenvEditor::save();

        $ini = new ConfigIniService();
        $ini->update("font_primary", $request->font_primary);
        $ini->update("font_secondary", $request->font_secondary);
        $ini->update("primary_font_family", $request->primary_font_family);
        $ini->update("secondary_font_family", $request->secondary_font_family);

        return redirect()->back()->with(['message' => "Changes Saved"]);
    }
    // --------------------------------------------------------------------------------------------
}