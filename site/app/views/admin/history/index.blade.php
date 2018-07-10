<div class="ng-cloak" ng-controller="historyCtrl">

    <h2 class="page-title" style="margin-top: 0">
        History
    </h2>

    
    <div class="form">
        <div class="form-group">
            <label>Year</label>
            <input type="text" ng-model="formData.year" class="form-control" required="" />
        </div>
        <div class="form-group">
            <label>Content</label>
            <trix-editor ng-model="formData.content" angular-trix></trix-editor>
        </div>
        <div class="form-group">
            <label>Size</label>
            <select ng-model="formData.size" ng-selected="formData.size" covert-to-number>
                <option ng-value="1">Small</option>
                <option ng-value="2">Big</option>
            </select>
        </div>
        <div class="">
            <button class="btn blue" ladda="processing" ng-click="addHistory()">
                @{{!editmode ? 'Add' : 'Update'}}
            </button>
            <button class="btn dark" ng-click="cancel()" ng-show="editmode">Cancel</button>
        </div>
    </div>

    <table class="table table-bordered" style="margin-top: 30px">
        <thead>
            <tr>
                <td>Year</td>
                <td>Content</td>
                <td>Size</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="history in history_data">
                <td>@{{history.year}}</td>
                <td ng-bind-html="history.content"></td>
                <td>
                    @{{history.size == 1 ? 'Small' : ''}}
                    @{{history.size == 2 ? 'Big' : ''}}
                </td>
                <td>
                    <button class="btn blue btn-sm" ng-click="edit(history)">Edit</button>
                    <button class="btn red btn-sm" ng-click="delete(history)" ladda="history.deleting">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
    
</div>