<?php
class FrontEndController extends BaseController {
    protected $layout = 'layout';
    
    public function index(){
    	$jobs = Job::get();
		return View::make('front-end.index',["jobs"=>$jobs]);
    }  
}