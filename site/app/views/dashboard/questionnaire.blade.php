@include('header')
@include('navigation')
<main class="ng-cloak" ng-controller="UserDashboardCtrl" ng-init="questionnaire_id={{(isset($questionnaire_id))?$questionnaire_id:0}}; initials();">
    <div class="dashboard" id="questionnaire">

        <div class="loading" ng-show="loading" style=""></div>

        <div class="tooltipMap" ng-show="displayTooltip"></div>

        <div style="background:#FFF" ng-hide="loading">

                <div class="questions">
                    <div ng-repeat="question in questions" class="question" id="question_@{{question.id}}" ng-show="question.show" ng-class="question.show ? 'active' : '' ">

                        <div class="title" ng-class="error_questions[question.id] == null ? '' : 'error' ">
                            <div class="container" style="position: relative;">
                                <span class="ques">@{{question.question}}</span>
                                <div style="color: #888" ng-if="question.type != 8">
                                    @{{question.other_remarks}}
                                </div>
                                <div class="ques-links">
                                    <span ng-if="question.remarks && question.remarks != ''" class="ttip" ng-click="openRemark(question,1)" ng-class="question.open_remark == 1 ? 'active' : '' ">
                                        Explanation
                                    </span>
                                    <span ng-if="question.show_example && question.show_example != ''" class="ttip"  ng-click="openRemark(question,2)" ng-class="question.open_remark == 2 ? 'active' : '' ">
                                        Example
                                    </span>
                                    <span ng-if="question.in_practice && question.in_practice != ''" class="ttip"  ng-click="openRemark(question,3)" ng-class="question.open_remark == 3 ? 'active' : '' ">
                                        Why This Matters
                                    </span>
                                </div>

                                <div class="remarks" ng-bind-html="question.remarks" ng-if="question.open_remark == 1"></div>

                                <div class="remarks" ng-bind-html="question.show_example" ng-if="question.open_remark == 2"></div>

                                <div class="remarks" ng-bind-html="question.in_practice" ng-if="question.open_remark == 3"></div>

                                <div class="leave-feeback">
                                    <div>
                                        <ul>
                                            <li>
                                                <a href="#"><i class="fa fa-ellipsis-v"></i></a>
                                                <ul>
                                                    <li>
                                                        <a href="javascript:;" ng-click="leaveFeedback(question.id)">Leave Feedback</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div ng-if="question.type == 4 || question.type == 5" class="input-ques">
                                <input type="text" ng-model="answers[question.id]" ng-keyup="error_questions[question.id] = null" ng-class="question.is_price == 1 ? 'price_format' : '' " />
                            </div>

                            <div class="option-groups" ng-if="question.type != 4 && question.type != 5" ng-class="question.option_direction == 2 ? 'horizontal' : '' ">

                                <div ng-repeat="option in question.options" class="options" ng-if="question.type != 8">
                                    <span ng-if="option.remarks && option.remarks != ''"  class="remark-circle" ng-click="option.show_remarks = !option.show_remarks">
                                        <i class="fa fa-question-circle"></i>
                                    </span>

                                    <div ng-if="question.type == 1" ng-click="chooseSingle(question, option.id)" ng-class="answers[question.id] == option.id ? 'active' : '' " id="option_@{{option.id}}">
                                        <i class="fa fa-check"></i>
                                        @{{option.name}}
                                        <span class="option-remarks" ng-show="option.show_remarks">
                                            @{{option.remarks}}
                                        </span>
                                    </div>

                                    <div ng-if="question.type == 2" ng-click="chooseMultiple(question, option.id)" ng-class="answers[question.id] ? answers[question.id].indexOf(option.id) != -1 ? 'active' : '' : '' ">
                                        <i class="fa fa-check"></i>
                                        @{{option.name}}
                                        <span class="option-remarks" ng-show="option.show_remarks">
                                            @{{option.remarks}}
                                        </span>
                                    </div>

                                    

                                </div>

                

                                <div ng-if="question.type == 3">
                                    <div style="margin: 0 20px;"><rzslider 
                                        rz-slider-model="answers[question.id]"
                                        rz-slider-options="slider.options"></rzslider></div>
                                </div>

                            </div>

                            <button class="btn blue" ng-click="goToNext(question,1)" ng-if="showNext(question)">
                                Next
                            </button>
                            
                        </div>

                    </div>
                </div>
        </div>
    </div>

    <div class="footer-questions">
         <div class="progess">
            <div style="width: @{{ (total_questions != 0)? (answered_questions*100/total_questions) : 0}}%"></div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <a href="{{url('/assets/files/Questionnaire.pdf')}}" target="_blank" class="btn btn-sm btn-block green">PDF</a>
            </div>
            <div class="col-md-5">
                <div>
                    <span class="answer_count">@{{answered_questions}}/@{{total_questions}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div id="submit_btn" class="form-buttons ng-cloak">
                    
                    <div >
                        <button class="btn" ladda="submitting" ng-disabled = "answered_questions != total_questions" ng-click="submit_response()" ng-class="answered_questions == total_questions ? 'green' : '' ">Submit</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.feedback_modal')
</main>

@include('footer')