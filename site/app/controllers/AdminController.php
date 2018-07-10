<?php
class AdminController extends BaseController {
    protected $layout = 'layout';
    
    public function index(){
        $this->layout->sidebar = View::make('sidebar',["mainsidebar"=>"dashboard","sidebar"=>"dashboard","subsidebar"=>"dashboard"]);
        $this->layout->main = View::make('dashboard');
    }

    public function questionnaire(){
        $questionnaires = DB::table("questionnaires")->get();
        $this->layout->sidebar = View::make('sidebar',["mainsidebar"=>"questionnaire","sidebar"=>"questionnaire","subsidebar"=>"questionnaire"]);
        $this->layout->main = View::make('admin.questionnaire.list',["questionnaires" => $questionnaires]);
    }

    public function jobs(){
        $jobs = DB::table("jobs")->get();
        $this->layout->sidebar = View::make('sidebar',["mainsidebar"=>"jobs","sidebar"=>"jobs","subsidebar"=>"jobs"]);
        $this->layout->main = View::make('admin.jobs.list',["jobs" => $jobs]);
    }

    public function uploadFile(){
        $destination = 'uploads/';
        
        if(Input::hasFile('media')){
            $file = Input::file('media');
            $extension = Input::file('media')->getClientOriginalExtension();
            if(in_array($extension, User::fileExtensions())){
                $name = strtotime("now").'.'.strtolower($extension);
                $file = $file->move($destination, $name);
                $data["media"] = $destination.$name;

                $data["success"] = true;
                $data["media_link"] = url($destination.$name);
            }else{
                $data['success'] = false;
                $data['message'] = 'Invalid file format';
            }
        }else{
            $data['success'] = false;
            $data['message'] ='file not found';
        }

        return Response::json($data, 200, array());
    }

}