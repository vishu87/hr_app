<?php
class QuestionController extends BaseController {
    protected $layout = 'layout';
    
    public function index($questionnaire_id){
        $questionnaire = DB::table("questionnaires")->find($questionnaire_id);
        $this->layout->sidebar = View::make('sidebar',["mainsidebar"=>"questionnaire","sidebar"=>"questions"]);
        $this->layout->main = View::make('admin.questions.list',["questionnaire"=>$questionnaire, "questionnaire_id"=>$questionnaire_id]);
    }

    public function initials(){
        $questions = Question::where('questionnaire_id',Input::get('questionnaire_id'))->where('hidden','!=',1)->orderBy('page_no','ASC')->orderBy('question_order','ASC')->get();
        
        $types = Question::type_list();
        foreach ($questions as $question) {
            $question->type = $types[$question->type];
            $question->follow_up = (int)$question->follow_up;
        }
        
        $data['questions'] = $questions;
        
    	$data['types'] = Question::types();
    	
        
        $data['operators'] = Option::operators();
        $data['question_categories'] = Question::getCategoryList();

        $data['success'] = true;
    	
        return Response::json($data,200,array());
    }

    public function loadParentQuestions($category_id){
        $parent_questions = Question::select('id','question')->where('category_id',$category_id)->get();
        $data['parent_questions'] = $parent_questions;
        $data['success'] = true;
        return Response::json($data,200,array());
    }

    public function loadParentOptions($question_id){
        $parent_options = Option::select('id','option_name')->where('question_id',$question_id)->get();
        $data['parent_options'] = $parent_options;
        $data['success'] = true;
        return Response::json($data,200,array());
    }

    public function checkFilter(){
        $field_id = Input::get('field_id');
        if($field_id > 0){
            $filter = InvestorFilter::find($field_id);
            if($filter){
                if($filter->type == 1){
                    $data['subtags'] = SubTag::where('tag_id',$filter->tag_id)->get();
                }
            }
            $data['success'] = true;
        }else{
            $data['success'] = false;
            $data['message'] = 'Field Not Found';
        }
        return Response::json($data,200,array());
    }


    public function loadSubTags($tag_id){
        $subtags = SubTag::select('id','subtag_name')->where('tag_id',$tag_id)->get();
        $data['subtags'] = $subtags;
        $data['success'] = true;
        return Response::json($data,200,array());
    }

    public function add(){
        
        $cre = [
            "question" =>  Input::get('question') ,
            "weightage" =>  Input::get('weightage') ,
            "type" =>  Input::get('type') ,
            "filter_match" => Input::get('filter_match'),
            "option_direction" => Input::get("option_direction")
        ];
        $rules = [
            "question" => 'required',
            "weightage" => 'required',
            "type" => 'required',
            "filter_match" => 'required',
            "option_direction" => "required"
        ];
        $validator = Validator::make($cre , $rules);
        if($validator->passes()){

            if(Input::has('ques_id') && Input::get('ques_id') != 0){
                $question = Question::find(Input::get('ques_id'));
            }else{
        	   $question = new Question;
               $question->questionnaire_id = Input::get('questionnaire_id');
            }
            $question->question = Input::get('question');
            $question->description = Input::get('description');
            $question->remarks = Input::get('remarks');
            $question->show_example = Input::get('show_example');
            $question->in_practice = Input::get('in_practice');
            
            $question->other_remarks = Input::get('other_remarks');
            $question->mandatory = Input::get('mandatory');
            $question->weightage = Input::get('weightage');
            $question->type = Input::get('type');
            $question->option_direction = Input::get('option_direction');
            $question->filter_match = Input::get('filter_match');
            $question->question_order = Input::get('question_order');

            if(Input::has('follow_up') && Input::get('follow_up') != 0){
                $question->follow_up = Input::get('follow_up');
                $question->parent_question_id = Input::get('parent_question_id');
            }else{
                $question->follow_up = 0;
                $question->parent_question_id = 0;
            }

            if(Input::has('is_price')){
                $question->is_price = Input::get('is_price');
            }else{
                $question->is_price = 0;
            }

            if(Input::has('option_group')){
                $question->option_group = Input::get('option_group');
            }else{
                $question->option_group = 0;
            }

            if(Input::has('option_group_type')){
                $question->option_group_type = Input::get('option_group_type');
            }else{
                $question->option_group_type = 0;
            }


            $question->save();

            ParentOptionMap::where('question_id',$question->id)->delete();
            $parent_options = Input::get('parent_options');
            if($question->follow_up != 0 && sizeof($parent_options) > 0){
                foreach ($parent_options as $key => $value) {
                    $parentQuestionOption = new ParentOptionMap;
                    $parentQuestionOption->question_id = $question->id;
                    $parentQuestionOption->parent_question_id = $question->parent_question_id;
                    $parentQuestionOption->option_id = $value;
                    $parentQuestionOption->save();
                }
            }

            $option_groups = Input::get('option_groups');
            if(sizeof($option_groups) > 0){
                foreach ($option_groups as $option_group) {
                    if(isset($option_group['id']) && $option_group['id'] != 0){
                        $optionGroup = OptionGroup::find($option_group['id']);
                    } else {
                        $optionGroup = new OptionGroup;      
                        $optionGroup->question_id = $question->id;              
                    }

                    $optionGroup->option_group_name = $option_group['option_group_name'];
                    $optionGroup->image = $option_group['image'];
                    $optionGroup->group_option_condition_id = $option_group['group_option_condition_id'];
                    $optionGroup->save();
                    
                    if(sizeof($option_group['options']) > 0){

                        foreach ($option_group['options'] as $option) {

                            if($option['option_name'] != ''){

                                if(isset($option['id']) && $option['id'] != 0){
                                    $newOption = Option::find($option['id']);
                                } else {
                                    $newOption = new Option;
                                    $newOption->question_id = $question->id;
                                    $newOption->option_group_id = $optionGroup->id;
                                }

                                $newOption->option_name = $option['option_name'];
                                $newOption->accept_reject = (isset($option['accept_reject']))?$option['accept_reject']:0;
                                $newOption->weight = (isset($option['weight']))?$option['weight']:null;
                                $newOption->remarks = (isset($option['remarks']))?$option['remarks']:null;
                                $newOption->save();

                            } else {
                                if(isset($option['id']) && $option['id'] != 0){
                                    Option::where('id',$option['id'])->delete();
                                    OptionSubTag::where('option_id',$option['id'])->delete();
                                }
                            }

                        }
                    }
                }
            }

            $types = Question::type_list();
            $question->type = $types[$question->type];
            $data['question'] = $question;
            $data['success'] = true;
            $data['message'] = 'Question added successfully';
        }else{
            $data['success'] = false;
            $data['message'] = $validator->messages()->first();
        }
    	return Response::json($data,200,array());
    }

    public function editQuestion($question_id){
        $question = Question::find($question_id);
        if($question->option_group == 1){
            $question->option_group = true;
        } else {
            $question->option_group = false;
        }
        if($question->is_price == 1){
            $question->is_price = true;
        } else {
            $question->is_price = false;
        }

        $options = Option::select('option_name','weight','id')->where('question_id',$question_id)->get();
        $count = 1;
        foreach ($options as $option) {
            $option->option_id = $count;
            $count++;
        }
        
        $parent_questions = Question::select('id','question')->where('category_id',$question->category_id)->get();
        $data['parent_questions'] = $parent_questions;

        $parent_options = Option::select('id','option_name')->where('question_id',$question->parent_question_id)->get();
        $data['parent_options'] = $parent_options;

        //for selected parent options
        $selecte_parent_options = ParentOptionMap::select('option_id')->where('question_id',$question->id)->lists('option_id');
        $question->parent_options = $selecte_parent_options;

        $question->options = $options;

        //for option groups
        $optionGroups = OptionGroup::where('question_id',$question_id)->get();
        foreach ($optionGroups as $group) {
            # code...
            $group->options = Option::where('question_id',$question_id)->where('option_group_id',$group->id)->get();

            if(sizeof($group->options) > 0){

                foreach ($group->options as $option) {
                    # code...
                    $option->sub_tags = OptionSubTag::where('option_id',$option->id)->lists('sub_tag_id','menu_id');

                    $option->filters = OptionFilter::where('option_id',$option->id)->get();

                    if($option->filters && sizeof($option->filters) > 0){
                        foreach ($option->filters as $filter) {
                            # code...
                            if($filter->field_id != 0 && $filter->field_id != null){
                                $investor_filter = InvestorFilter::where('id',$filter->field_id)->first();
                                if($investor_filter && $investor_filter->type == 1){
                                    $filter->subtags = SubTag::where('tag_id',$investor_filter->tag_id)->get();
                                    $filter->show_tag = true;
                                    $filter->show_value = false;
                                }else{
                                    $filter->show_tag = false;
                                    $filter->show_value = true;
                                }
                            }
                        }
                    }
                }
            }


        }
        $question->option_groups = $optionGroups;
        $data['question'] = $question;
        $data['success'] = true;
        return Response::json($data,200,array());

    }
    
    public function deleteQuestion($question_id){
        $question = Question::find($question_id);
        if($question){
            Question::where('id',$question_id)->delete();
            OptionGroup::where('question_id',$question_id)->delete();
            Option::where('question_id',$question_id)->delete();
            $data['success'] = true;
            $data['message'] = 'Question removed successfully';
        }else{
            $data['success'] = false;
            $data['message'] = 'Question not found ';
        }
        $data['success'] = true;
        return Response::json($data,200,array());
    }

    public function savePageNos(){
        $questions = Input::get('questions');

        foreach ($questions as $question) {
            $ques = Question::find($question["id"]);
            $ques->page_no = $question["page_no"];
            $ques->question_order = $question["question_order"];
            $ques->save();
        }

        $data['success'] = true;
        $data['message'] = "Successfully saved";
        return Response::json($data,200,array());
    }

    public function changeCategory(){
        if(Input::has('category_id') && Input::has('id')){
            $ques = Question::find(Input::get('id'));
            $ques->category_id = Input::get('category_id');
            $ques->save();
            $data['success'] = true;
            $data['message'] = "Question category is changed successfully";
            $data['question'] = $ques;
        }else{
            $data['success'] = false;
            $data['message'] = "This Question does not exist or Invalid request ";
        }

        return Response::json($data,200,array());
    }
}