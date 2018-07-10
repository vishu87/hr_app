<?php
class SettingsController extends BaseController {
    protected $layout = 'layout';
    
    public function index(){
        $settings = Settings::all();
        $this->layout->sidebar = View::make('sidebar',["mainsidebar"=>"administration","sidebar"=>"administration","subsidebar"=>"settings"]);
        $this->layout->main = View::make('admin.settings.index',["settings" => $settings]);
    }

    public function save(){
        $destination = 'uploads/';

        $settings = Settings::all();

        foreach ($settings as $setting) {
            if($setting->type == 'text' || $setting->type == 'radio'){
                if(Input::has("setting_".$setting->id)){
                    $setting->value = Input::get("setting_".$setting->id);
                    $setting->save();
                }
            }

            if($setting->type == 'file'){
                $file_setting_slug = "setting_".$setting->id;
                if(Input::hasFile($file_setting_slug)){
                    $file = Input::file($file_setting_slug);
                    $extension = Input::file($file_setting_slug)->getClientOriginalExtension();
                    if(in_array($extension, User::fileExtensions())){
                        $name = strtotime("now").'.'.strtolower($extension);
                        $file = $file->move($destination, $name);
                        $setting->value = url($destination.$name); 
                        $setting->save();
                    }
                }
            }
        }
        
        return Redirect::back();
    }

}