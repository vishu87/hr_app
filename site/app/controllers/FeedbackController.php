<?php
class FeedbackController extends BaseController {
    protected $layout = 'layout';
    
    public function store(){
        
        $feedback = new Feedback;
        $feedback->type = 1;
        $feedback->question_id = Input::get('question_id');
        $feedback->subject = Input::get('subject');
        $feedback->feedback = Input::get('feedback');
        $feedback->user_id = Auth::id();
        $feedback->save();

        $data['success'] = true;
        $data['message'] ='Your feedback is successfully saved';

        return Response::json($data, 200, array());

    }


}