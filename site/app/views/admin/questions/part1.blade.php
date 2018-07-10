<div class="modal-body" ng-if="part1" >            
    <div class="form-group">
        <label>Question</label>
        <input type="text" ng-model="quesData.question" class="form-control" required="true" placeholder="Question">
    </div>
    <div class="row">
        <div class="col-md-8 form-group">
            <label>Description</label>
            <input type="text" ng-model="quesData.description" class="form-control" placeholder="Description">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Option Direction <span class="error">*</span></label>
                <select class="form-control" ng-model="quesData.option_direction" convert-to-number>
                    <option value=""> Select</option>
                    <option value="1"> Vertical</option>
                    <option value="2"> Horizontal</option>
                </select>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label>Mandatory</label>
                <select class="form-control" ng-model="quesData.mandatory" convert-to-number>
                    <option value=""> Select</option>
                    <option value="1"> Yes</option>
                    <option value="0"> No</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 form-group">
            <label>Remarks (Explaination)</label>
            <trix-editor ng-model="quesData.remarks" angular-trix></trix-editor>
        </div>
        <div class="col-md-12 form-group">
            <label>Example</label>
            <trix-editor ng-model="quesData.show_example" angular-trix></trix-editor>
        </div>
        <div class="col-md-12 form-group">
            <label>Why this matters?</label>
            <trix-editor ng-model="quesData.in_practice" angular-trix></trix-editor>
        </div>
        <div class="col-md-12 form-group">
            <label>Help</label>
            <input type="text" ng-model="quesData.other_remarks" class="form-control" placeholder="Help">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Type</label><span class="error"> *</span>
                <select ng-model="quesData.type" class="form-control" convert-to-number>
                    <option ng-repeat="type in types" ng-value="type.id">@{{type.name}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Order</label><span class="error"> *</span>
                <input type="text" ng-model="quesData.question_order" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Weightage</label><span class="error"> *</span>
                <input type="text" ng-model="quesData.weightage" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Question Type <span class="error"> *</span></label>
                <select ng-model="quesData.filter_match" class="form-control" convert-to-number="true">
                    <option value="">Select</option>
                    <option value="1">Accept/Reject</option>
                    <option value="2">Points</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Is this a follow up question</label><span class="error"> *</span>
                <select ng-model="quesData.follow_up" ng-change="loadParentQuestions()" class="form-control" convert-to-number >
                    <option ng-repeat="type in follow_up_types" value="@{{type.id}}">@{{type.type}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-4" ng-if="quesData.follow_up == 1">
            <div class="form-group">
                <label>Parent Question</label><span class="error"> *</span>
                <select ng-model="quesData.parent_question_id" ng-change="loadParentOptions()" class="form-control">
                    <option ng-repeat="question in parent_questions" ng-value="question.id">@{{question.question}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-4" ng-if="quesData.follow_up == 1">
            <div class="form-group">
                <label>Options</label><span class="error"> *</span>
                <select ng-model="quesData.parent_options" class="form-control" multiple="true">
                    <option ng-repeat="option in parent_options" ng-value="option.id">@{{option.option_name}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" style="margin-top:25px">
                <label>Price Format</label>
                <input type="checkbox" ng-model="quesData.is_price" />
            </div>
        </div>
    </div>
    <div class="" style="text-align: right;">
        <button type="submit" class="btn yellow" ng-click="continue()" ladda="processing">Continue</button>
    </div>
</div>