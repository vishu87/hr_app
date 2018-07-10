<div class="ng-cloak" ng-controller="glossaryCtrl">

    <h2 class="page-title" style="margin-top: 0">
        Glossary
    </h2>

    
    <div class="form">
        <div class="form-group">
            <label>Term</label>
            <input type="text" ng-model="formData.name" class="form-control" required="" />
        </div>
        <div class="form-group">
            <label>Content</label>
            <trix-editor ng-model="formData.content" angular-trix></trix-editor>
        </div>
        
        <div class="">
            <button class="btn blue" ladda="processing" ng-click="addGlossary()">
                @{{!editmode ? 'Add' : 'Update'}}
            </button>
            <button class="btn dark" ng-click="cancel()" ng-show="editmode">Cancel</button>
        </div>
    </div>

    <table class="table table-bordered" style="margin-top: 30px">
        <thead>
            <tr>
                <td>ID</td>
                <td>Term</td>
                <td>Content</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="glossary in glossary_data">
                <td>@{{glossary.id}}</td>
                <td>@{{glossary.name}}</td>
                <td ng-bind-html="glossary.content"></td>
                
                <td>
                    <button class="btn blue btn-sm" ng-click="edit(glossary)">Edit</button>
                    <button class="btn red btn-sm" ng-click="delete(glossary)" ladda="glossary.deleting">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
    
</div>