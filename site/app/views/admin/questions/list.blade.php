<div ng-controller="QuesCtrl" ng-init="questionnaire_id={{$questionnaire_id}};initials();" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                {{$questionnaire->name}}
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue" ng-click="addQues()">Add Question</button>
        </div>
    </div>

    <div class="ng-cloak">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;">SN</th>
                    <th style="width: 50px;">ID</th>
                    <th style="width: 50px;">Order</th>
                    <th>Question</th>
                    <th>Type</th>
                    <th>Rank</th>
                    <th>Follow Up</th>
                    <th style="width: 180px"> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="ques in questions">
                    <td> @{{$index+1}}</td>
                    <td> @{{ques.id}} </td>
                    <td><input type="text" ng-model="ques.question_order" style="width: 50px" tabindex="@{{$index + 1}}"></td>
                    <td> @{{ques.question}} </td>
                    <td> @{{ques.type}} </td>
                    <td> @{{ques.rank}} </td>
                    <td>@{{(ques.follow_up == 1)?'Yes':'No'}}</td>
                    <td>
                        <button class="btn btn-primary uppercase " style="margin-top: 2px;" ng-click="editQues(ques)" ladda="ques.process">Edit</button>

                        <button class="btn red-mint uppercase " style="margin-top: 2px;" ng-click="deleteQues(ques.id,$index)" ladda="processing_@{{$index}}"><i class="fa fa-remove"></i></button>

                    </td>
                </tr>
                    
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <button class="btn btn-primary" ladda="page_no_saving" ng-click="savePageNos()">Save Page Numbers & Order</button>
    </div>

    <!-- Begin  Modal -->
    <div id="questions" class="modal fade in modal-overflow" data-width="790">
        <div class="modal-header">
            <button type="button" class="close" ng-click="resetQuesData()" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(ques_id != 0)?'Update':'Add'}} Question</h4>
        </div>
        @include('admin.questions.part1')
        @include('admin.questions.part2')

    </div>

    <div id="questionCategory" class="modal fade in modal-overflow" data-width="790">
        <div class="modal-header">
            <button type="button" class="close" ng-click="resetQuesData()" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Change Question Category</h4>
        </div>
        <div class="modal-body">
            <h4 class="page-title">@{{current_question.question}}</h4>
            <!-- <pre>@{{current_question}}</pre> -->
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Question Category</label>
                    <select class="form-control" ng-model="current_question.category_id" convert-to-number>
                        <option ng-repeat="category in question_categories" value="@{{category.id}}">@{{category.name}}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" ng-click="changeCategory(current_question)" ladda="current_question.processing" style="margin-top: 24px;">Change</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
       
</div>