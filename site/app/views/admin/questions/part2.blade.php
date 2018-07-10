<div class="modal-body" ng-if="part2">
    
    <div ng-repeat="option_group in quesData.option_groups track by $index" style="margin-bottom: 20px">
        <table class="table">
            <thead>
                <tr>
                    <td>Answer</td>
                    <td ng-hide="quesData.filter_match == 2">Accept/Reject</td>
                    <td>Points</td>
                </tr>
            </thead>
            <tbody ng-repeat="option in option_group.options track by $index">
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" ng-model="option.option_name" class="form-control" placeholder="Answer">
                        </div>
                    </td>
                    <td ng-hide="quesData.filter_match == 2">
                        <div class="form-group">
                            <select class="form-control" ng-model="option.accept_reject" convert-to-number>
                                <option>Select</option>
                                <option value="1">Accept</option>
                                <option value="2">Reject</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" ng-model="option.weight" class="form-control" placeholder="Points">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" style="border-top:0">
                        <div class="form-group" style="margin: 0">
                            <input type="text" ng-model="option.remarks" class="form-control" placeholder="Remarks">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn yellow " ng-click="addOption(option_group)">Add More</button>
    </div>
    
    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            
            <button class="btn btn default " ng-click="goback()">Go Back</button>
        </div>
        <div class="col-md-6" style="text-align: right;">
            <button class="btn btn green" ng-click="onSubmit()" ladda="processing">Submit</button>
        </div>
    </div>
</div>