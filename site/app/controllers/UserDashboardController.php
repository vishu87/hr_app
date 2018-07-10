<?php
class UserDashboardController extends BaseController {
    protected $layout = 'layout';

    public function index(){
        return View::make('dashboard.index',["default_header" => 1]);
    }

    public function questionnaire($questionnaire_id){
        
        return View::make('dashboard.questionnaire',[
            "default_header" => 2,
            "questionnaire_id"=>$questionnaire_id
        ]);
    }

    public function map(){
        return View::make('dashboard.map');
    }

    public function profile(){

        $glossary = Glossary::lists("content","id");

        $profiles = array(
            array (
                "prefix" => "Type of",
                "term" => "Impact Investor",
                "glossary" => 1,
                "icon" => "Male.svg"
            ),
            array (
                "prefix" => "",
                "term" => "Impact Class",
                "glossary" => 2,
                "icon" => "Green-Energy.svg"
            ),
            array (
                "prefix" => "",
                "term" => "Portfolio Objective",
                "glossary" => 4,
                "icon" => "Target.svg"
            ),

            array (
                "prefix" => "",
                "term" => "Portfolio Size",
                "glossary" => 5,
                "icon" => "Wallet-2.svg"
            ),
            array (
                "prefix" => "",
                "term" => "Time Horizon",
                "glossary" => 6,
                "icon" => "Sand-watch2.svg"
            ),
            array (
                "prefix" => "",
                "term" => "Return Expectations",
                "glossary" => 7,
                "icon" => "Bar-Chart.svg"
            ),
            array (
                "prefix" => "",
                "term" => "Risk Tolerance",
                "glossary" => 8,
                "icon" => "Gaugage-2.svg"
            ),
            array (
                "prefix" => "",
                "term" => "Impact Sector Preference",
                "glossary" => 9,
                "icon" => "Environmental-2.svg"
            ),
        );

        return View::make('dashboard.profile',[
            "default_header" => 1,
            "title" => "Impact Investor Profile",
            "glossary_id" => 10,
            "icon" => "assets/svg/Checked-User.svg",
            "glossary" => $glossary,
            "profiles" => $profiles,
            "tab" => 1,
            "subtab" => 3
        ]);
    }

    public function strategyPDF(){

        return View::make('dashboard.create_pdf_strategy',[
            "default_header" => 1,
            "title" => "Impact Investment Policy Statement",
            "tab" => 0,
            "subtab" => 0
        ]);
    }

    public function product($investment_id){
        
        $investment = Investment::select('investments.id','product_name','company_name')->join('entrepreneurs','entrepreneurs.id','=','investments.entrepreneur_id')->where('investments.id',$investment_id)->first();

        $impact_types = $this->impactTypes();
        $financial_types = $this->financialTypes();

        return View::make('dashboard.product',[
            "default_header" => 1,
            "title" => $investment->product_name,
            "sub_title" => $investment->company_name,
            "investment" => $investment,
            "impact_types" => $impact_types,
            "financial_types" => $financial_types,
            "investment_buttons" => 1,
            "tab" => 0,
            "subtab" => 0
        ]);
    }

    public function createPDF($investment_id){
        $investment = Investment::select('investments.id','product_name','company_name','entrepreneur_id')->join('entrepreneurs','entrepreneurs.id','=','investments.entrepreneur_id')->where('investments.id',$investment_id)->first();
        $entrepreneur = Entrepreneur::select('entrepreneurs.id','entrepreneur_headquarters.address')->leftJoin('entrepreneur_headquarters','entrepreneurs.id','=','entrepreneur_headquarters.entrepreneur_id')->where('entrepreneurs.id',$investment->entrepreneur_id)->first();

        return View::make('dashboard.create_pdf',[
            "default_header" => 1,
            "title" => $investment->product_name,
            "sub_title" => $investment->company_name,
            "investment" => $investment,
            "entrepreneur" => $entrepreneur,
            "tab" => 0,
            "subtab" => 0
        ]);
    }

    public function strategy(){
        $glossary = Glossary::lists("content","id");

        return View::make('dashboard.strategy',[
            "default_header" => 1,
            "glossary_id" => 11,
            "title" => "Impact Strategy",
            "icon" => "assets/svg/Gears.svg",
            "glossary" => $glossary,
            "tab" => 1,
            "subtab" => 4
        ]);
    }

    public function history(){
        $history = History::orderBy('year','ASC')->get();
        $colors = [
            "#4984be","#c8272b","#feaf17","#1d949a","#f58221","#91a83d","#253f8f"
        ];
        $color_count = sizeof($colors) - 1;

        $glossaries = Glossary::get();
        $subtags = SubTag::whereNotNull('remarks')->get();

        return View::make('dashboard.history',[
            "default_header" => 1,
            "title" => "Impact Investment",
            "icon" => "assets/svg/Gears.svg",
            "history_data" => $history,
            "colors" => $colors,
            "color_count" => $color_count,
            "glossaries" => $glossaries,
            "subtags" => $subtags,
            "tab" => 0,
            "subtab" => 0
        ]);
    }

    public function home(){
        if(Auth::user()->profile_status < 3){
            return View::make('dashboard.home',["default_header" => 1,"tab" => 0,
            "subtab" => 0]);
        } else {
            return View::make('dashboard.home_investments',["default_header" => 1,"tab" => 0,
            "subtab" => 0]);
        }
    }

    public function recommendations(){
        return View::make('dashboard.recommendations',[
            "default_header" => 1,
            "title" => "Top Matches",
            "icon" => "assets/svg/Target.svg",
            // "more_ques" => 1,
            "show_list" => 1,
            "tab" => 0,
            "subtab" => 0
        ]);
    }

    public function search(){
        return View::make('dashboard.search',[
            "default_header" => 1,
            "title" => "Investments Map",
            "icon" => "assets/svg/Internet.svg",
            "tab" => 2,
            "subtab" => 1
        ]);
    }

    public function portfolio(){
        return View::make('dashboard.portfolio',[
            "default_header" => 1,
            "title" => "Holdings",
            "icon" => "assets/svg/Full-Cart.svg",
            "tab" => 1,
            "subtab" => 5
        ]);
    }

    public function impactReport(){
        return View::make('dashboard.impact_report',[
            "default_header" => 1,
            "title" => "Impact Reporting",
            "icon" => "assets/svg/Environmental-2.svg",
            "tab" => 3,
            "subtab" => 1
        ]);
    }

    public function impactReportBeta(){
        return View::make('dashboard.impact_report.index',[
            "default_header" => 1,
            "title" => "Impact Reporting",
            "icon" => "assets/svg/Environmental-2.svg",
            "tab" => 3,
            "subtab" => 1
        ]);
    }

    public function financialReport(){
        return View::make('dashboard.financial_report',[
            "default_header" => 1,
            "title" => "Financial Reporting",
            "icon" => "assets/svg/Bar-Chart.svg",
            "tab" => 3,
            "subtab" => 2
        ]);
    }

    public function compare(){
        return View::make('dashboard.compare',[
            "default_header" => 1,
            "title" => "Impact Optimization",
            "icon" => "assets/svg/Scale.svg",
            "tab" => 0,
            "subtab" => 0
        ]);
    }

    public function whatYouOwn(){
        return View::make('dashboard.whatyouown',[
            "default_header" => 1,
            "tab" => 1,
            "subtab" => 2,
            "title" => "Impact Assessment",
            "icon" => "assets/svg/Wallet-2.svg"
        ]);
    }

    public function recommededPortfolio(){
        return View::make('dashboard.recommended',[
            "default_header" => 1,
            "title" => "Recommended Portfolio",
            "icon" => "assets/svg/Wallet-2.svg",
            "tab" => 0,
            "subtab" => 0
        ]);   
    }

    public function investmentAnalytics(){
        // $glossary = Glossary::lists("content","id");

        return View::make('dashboard.analytics',[
            "default_header" => 1,
            "title" => "Investment Analytics",
            "icon" => "assets/svg/Gears.svg",
            "tab" => 4,
            "subtab" => 1
        ]);
    }

    public function load($questionnaire_id){
        
        

        $ranks = [];

        $questions = Question::where('questionnaire_id',$questionnaire_id)->where('hidden','!=',1)->orderBy('page_no','ASC')->orderBy('question_order','ASC')->get();

    	foreach ($questions as $question) {
    		$child_questions = Question::where('parent_question_id',$question->id)->lists('id');

            $question->childs = (sizeof($child_questions) > 0)?true:false;
            $question->child_questions = $child_questions;

            if($question->follow_up == 1 && $question->parent_question_id != 0){
                $open_options = DB::table('parent_question_option_mapping')->where('question_id',$question->id)->where('parent_question_id',$question->parent_question_id)->remember(5)->lists('option_id');
                $open_options_final = [];
                foreach ($open_options as $open_option) {
                    $open_options_final[] = $open_option;
                }
                $question->open_options = $open_options_final;
            }

            $option_group = OptionGroup::where('question_id',$question->id)->first();
    		// foreach ($option_groups as $option_group) {
    			$options = Option::select('id','option_name as name','weight','option_group_id','question_id','remarks')->where('option_group_id',$option_group->id)->remember(5)->get();
                // $option_group->options = $options;
    			// $option_group->option_defaults = [];
                $question->options = $options;
                $question->option_defaults = [];
                if($question->type == 8){
                    $ranks[] = $options;
                    $ranks[] = [];
                }


            $question->show = ($question->follow_up == 1)?false:true;
    	}


        $data["success"] = true;
        $data["questions"] = $questions;
        return Response::json($data,200,array());
    }

    public function load_OLD($type = 0){
        
        if($type == 0){
            $categories = DB::table('question_categories')->whereIn('id',array(1,2,3,4))->get();
        } else {
            $categories = DB::table('question_categories')->where('id',5)->get();
        }

        $ranks = [];
        foreach ($categories as $category) {

            $questions = Question::where('category_id',$category->id)->where('hidden','!=',1)->orderBy('question_order','ASC')->remember(5)->get();

            foreach ($questions as $question) {
                $child_questions = Question::where('parent_question_id',$question->id)->lists('id');

                $question->childs = (sizeof($child_questions) > 0)?true:false;
                $question->child_questions = $child_questions;

                if($question->follow_up == 1 && $question->parent_question_id != 0){
                    $open_options = DB::table('parent_question_option_mapping')->where('question_id',$question->id)->where('parent_question_id',$question->parent_question_id)->remember(5)->lists('option_id');
                    $open_options_final = [];
                    foreach ($open_options as $open_option) {
                        $open_options_final[] = $open_option;
                    }
                    $question->open_options = $open_options_final;
                }

                $option_groups = OptionGroup::where('question_id',$question->id)->get();
                foreach ($option_groups as $option_group) {
                    $options = Option::select('id','option_name as name','weight','option_group_id','question_id','remarks')->where('option_group_id',$option_group->id)->remember(5)->get();
                    $option_group->options = $options;
                    $option_group->option_defaults = [];
                    if($question->type == 8){
                        $ranks[] = $options;
                        $ranks[] = [];
                    }

                }
                $question->option_groups = $option_groups;
            }

            $category->questions = $questions;
        }

        $continents = Location::where('type',1)->select('id','name','type')->remember(100)->get();

        $continents = [];

        $locations = [];

        $location_ar = Location::remember(100)->get();
        foreach ($location_ar as $location) {
            $location->uniqid = $location->id.'_'.$location->type;
            $location->location_type = ($location->type == 1 || $location->type == 2)?1:2;

            $location->div_id = "";
            
            if($location->type == 2){
                $location->div_id = $location->ISO;
            } else if($location->type == 3) {
                $location->div_id = $location->code."_1";
            }

            if($location->type == 1){
                $location->countries = Location::select('ISO')->where('continent_id',$location->id)->remember(100)->lists('ISO');
                $continents[] = $location;
            }
            
            $locations[] = $location;
        }


        // foreach ($continents as $location) {
        //     $location->uniqid = $location->id.'_'.$location->type;
        //     $location->location_type = 1;
        //     $location->div_id = "";
        //     $location->countries = Location::select('ISO')->where('continent_id',$location->id)->lists('ISO');
        //     $locations[] = $location;
        // }

        // $countries = Location::where('type',2)->select('id','name','type','continent_id','ISO')->remember(100)->get();
        // foreach ($countries as $location) {
        //     $location->uniqid = $location->id.'_'.$location->type;
        //     $location->location_type = 1;
        //     $location->div_id = $location->ISO;
        //     $locations[] = $location;
        // }

        // $states = Location::where('type',3)->select('id','name','type','code')->remember(100)->get();
        // foreach ($states as $location) {
        //     $location->uniqid = $location->id.'_'.$location->type;
        //     $location->location_type = 2;
        //     $location->div_id = $location->code."_1";
        //     $locations[] = $location;
        // }

        // $cities = Location::where('type',4)->select('id','name','type','state_id','country_id')->remember(100)->get();
        // foreach ($cities as $location) {
        //     $location->uniqid = $location->id.'_'.$location->type;
        //     $location->location_type = 2;
        //     $locations[] = $location;
        // }

        $data["success"] = true;
        $data["categories"] = $categories;
        $data["locations"] = $locations;
        $data["continents"] = $continents;
        $data["ranks"] = $ranks;
        return Response::json($data,200,array());
    }

    public function submitResponse(){

        $questionnaire_id = Input::get('questionnaire_id');

        $user_id = Auth::id();

        $answers = Input::get("answers");

        $old_answer_ids = DB::table('answers')->select('answers.id')->join('questions','answers.question_id','=','questions.id')->where('user_id',$user_id)->where('questions.questionnaire_id',$questionnaire_id)->lists('id');

        if(sizeof($old_answer_ids) > 0){
            DB::table('answers')->whereIn('id',$old_answer_ids)->delete();
            DB::table('answer_options')->whereIn('answer_options.answer_id',$old_answer_ids)->delete();
        }

        foreach ($answers as $question_answer) {

            $answer = new Answer;
            $answer->user_id = $user_id;
            $answer->questionnaire_id = $questionnaire_id;
            $answer->question_id = $question_answer["question_id"];
            $answer->save();

            if(is_array($question_answer["answers"])){
                $count = 1;
                foreach ($question_answer["answers"] as $single_answer) {

                    $answer_option = new AnswerOption;
                    $answer_option->answer_id = $answer->id;

                    $geo_type = 0;

                    if(is_array($single_answer)){
                        $final_value = $single_answer["id"];
                    } else {
                        $final_value = $single_answer;
                    }

                    $answer_option->value = $this->storeValue($question_types[$question_answer["question_id"]], $final_value);
                    $answer_option->option_id = $this->storeOption($question_types[$question_answer["question_id"]], $final_value);

                    $answer_option->save();

                    $count++;
                }
            } elseif ($question_answer["answers"]){
                $answer_option = new AnswerOption;
                $answer_option->answer_id = $answer->id;

                $final_value = $question_answer["answers"];

                $answer_option->value = $this->storeValue($question_types[$question_answer["question_id"]], $final_value);

                $answer_option->option_id = $this->storeOption($question_types[$question_answer["question_id"]], $final_value);

                $answer_option->save();
            }

        }
        $data["success"] = true;
        $data["message"] = 'successfully saved';
        return Response::json($data,200,array());
    }

    public function storeRank($question_type, $count){
        $store_rank = array("8","12");
        if(in_array($question_type, $store_rank)){
            return $count;
        } else return 0;
    }

    public function storeValue($question_type, $value){
        $store_value = array("3","4","5");
        if(in_array($question_type, $store_value)){
            return $value;
        } else return '';
    }

    public function storeOption($question_type, $value){
        $store_option = array("1","2","6","7","8","9");
        if(in_array($question_type, $store_option)){
            return $value;
        } else return 0;
    }
  
}
