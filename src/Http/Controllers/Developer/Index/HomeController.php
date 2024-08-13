<?php

namespace Symlink\LaravelHelper\Http\Controllers\Developer\Index;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symlink\LaravelHelper\Helpers\Dropzone\DropzoneHelper;
use Symlink\LaravelHelper\Services\ConfigIniService;
use Symlink\LaravelHelper\Support\DotEnv\DotEnv;
use Symlink\LaravelHelper\Support\Sass\Sass;

class HomeController extends Controller {
    // --------------------------------------------------------------------------------------------
    public function showHome() {

        $ini = new ConfigIniService();

        return view('symlink::developer.index.home', [
            "app_name" => env("APP_NAME"),
            "app_url" => env("APP_URL"),
            "font_primary" => $ini->get('font_primary'),
            "font_secondary" => $ini->get('font_secondary'),
            "primary_font_family" => $ini->get('primary_font_family'),
            "primary_font_family_backup" => $ini->get('primary_font_family_backup'),
            "secondary_font_family" => $ini->get('secondary_font_family'),
            "secondary_font_family_backup" => $ini->get('secondary_font_family_backup'),

            "bs_primary" => $ini->get('bs_primary'),
            "bs_secondary" => $ini->get('bs_secondary'),
            "bs_success" => $ini->get('bs_success'),
            "bs_danger" => $ini->get('bs_danger'),
            "bs_warning" => $ini->get('bs_warning'),
            "bs_light" => $ini->get('bs_light'),
            "bs_info" => $ini->get('bs_info'),
            "bs_dark" => $ini->get('bs_dark'),
        ]);

    }
    // --------------------------------------------------------------------------------------------
    public function showAssets() {
        return view("symlink::developer.index.assets");
    }
    // --------------------------------------------------------------------------------------------
    public function updateStyles(){


        $sass_file = resource_path("/sass/generated/generatedBySymlink.scss");
        $sass = new Sass();
        $ini = new ConfigIniService();

        if (config("app.env") != "local"){
            dd("test");
            return redirect()->route('dev.index')->with([
                'message' => "Can only opdate in a local environment!",
                "color" => "warning",
            ]);
        }

        if($font_primary = $ini->get("primary_font_family")) {
            $sass->add([
                ".font-primary" => [
                    "font-family" => "'{$font_primary}', '{$ini->get("primary_font_family_backup")}'",
                ],
            ]);
        }

        if ($font_secondary = $ini->get("secondary_font_family")) {
            $sass->add([
                ".font-secondary" => [
                    "font-family" => "'{$font_secondary}', '{$ini->get("secondary_font_family_backup")}'",
                ],
            ]);
        }

        $sass->writeTofile($sass_file);

        $bootstrap_sass = new Sass();
        $bootstrap_sass->write_bootstrap_theme_colors();

        return redirect()->route('dev.index')->with([
            'message' => "Styles updated!",
        ]);

    }
    // --------------------------------------------------------------------------------------------
    public function reset_colors(){
        $default = [
            "primary" => "#007bff",
            "secondary" => "#6c757d",
            "success" => "#28a745",
            "info" => "#17a2b8",
            "warning" => "#ffc107",
            "danger" => "#dc3545",
            "light" => "#f8f9fa",
            "dark" => "#343a40",
        ];

        $ini = new ConfigIniService();
        foreach($default as $type => $color){
            $ini->update("bs_{$type}", $color);
        }

        $this->updateStyles();

        return redirect()->back()->with(['message' => "Colors Reverted To Default"]);
    }
    // --------------------------------------------------------------------------------------------
    public function storeAssets(Request $request){

        $dropzone_helper = new DropzoneHelper("asset_logo");
        $asset_logo = $dropzone_helper->getFiles();


        $public_assets = public_path("assets");
        if (!file_exists($public_assets)){
            mkdir($public_assets);
        }
        foreach ($asset_logo as $asset){
            copy($asset['original'], $public_assets."/logo.png");
        }
        $dropzone_helper->clear_temp();

        return redirect()->back()->with(['message' => "Assets Updated!"]);
    }
    // --------------------------------------------------------------------------------------------
    public function storeGeneralSettings(Request $request) {
        $env = new DotEnv();
        $env->update("APP_NAME", $request->app_name);
        $env->update("APP_URL", $request->app_url);
        $env->save();

        $ini = new ConfigIniService();
        $ini->update("font_primary", $request->font_primary);
        $ini->update("font_secondary", $request->font_secondary);
        $ini->update("primary_font_family_backup", $request->primary_font_family_backup);
        $ini->update("primary_font_family", $request->primary_font_family);
        $ini->update("secondary_font_family", $request->secondary_font_family);
        $ini->update("secondary_font_family_backup", $request->secondary_font_family_backup);

        $ini->update("bs_primary", $request->bs_primary);
        $ini->update("bs_secondary", $request->bs_secondary);
        $ini->update("bs_success", $request->bs_success);
        $ini->update("bs_danger", $request->bs_danger);
        $ini->update("bs_warning", $request->bs_warning);
        $ini->update("bs_info", $request->bs_info);
        $ini->update("bs_light", $request->bs_light);
        $ini->update("bs_dark", $request->bs_dark);

        $this->updateStyles();

        return redirect()->back()->with(['message' => "Changes Saved"]);
    }
    // --------------------------------------------------------------------------------------------
}
