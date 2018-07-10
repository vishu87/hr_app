<div class="ng-cloak" ng-controller="graphCtrl" ng-init="initials()">

    <div class="row">
        <div class="col-md-6">
            <h2 class="page-title" style="margin-top: 0">
                Graphs
            </h2>
            
        </div>
        <div class="col-md-6">
            <button class="btn blue pull-right" ng-click="addGraph()">Add</button>
        </div>
    </div> 


    <table class="table table-bordered" style="margin-top: 30px">
        <thead>
            <tr>
                <td>SN</td>
                <td>Name</td>
                <td>Term</td>
                <td>Type</td>
                <td>Glossary</td>
                <td>#</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="graph in graphs">
                <td>@{{$index+1}}</td>
                <td>@{{graph.name}}</td>
                <td>@{{graph.term}}</td>
                <td>@{{graph.type}}</td>
                <td>@{{graph.glossary_name}}</td>
                
                <td>
                    <button class="btn blue btn-sm" ng-click="edit(graph)">Edit</button>
                    <button class="btn red btn-sm" ng-click="delete(graph,$index)" ladda="graph.deleting">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
    

    <div id="graphs" class="modal bs-modal-sm fade in modal-overflow" data-width="80%">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(formData.id)?'Update':'Add'}} Graph</h4>
        </div>
        <div class="modal-body" >
            <form name="GraphForm" ng-submit="onSubmit(GraphForm.$valid)">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" ng-model="formData.name" class="form-control" placeholder="Graph Name" required >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Term</label>
                            <input type="text" ng-model="formData.term" class="form-control" placeholder="Term" required >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" ng-model="formData.type">
                                <option value="">Select</option>
                                <option ng-repeat="type in types" value="@{{type.id}}">@{{type.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Glossary</label>
                            <select class="form-control" ng-model="formData.glossary_ids" convert-to-number>
                                <option value="">Select</option>
                                <option ng-repeat="glossary in glossaries" value="@{{glossary.id}}">@{{glossary.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks</label>
                            <input type="text" ng-model="formData.remarks" class="form-control" placeholder="Term" >
                        </div>
                        <div class="form-group">
                            <button ng-show="formData.image == '' || formData.image == null" class="button btn upload-btn" ngf-select="uploadFile($file,'image',formData)" ngf-max-size="5MB" ladda="formData.uploading" data-style="expand-right" >Select Image</button>

                            <a class="btn blue ng-cloak" href="{{url('/')}}/@{{formData.image}}" ng-show="formData.image && formData.image != '' " target="_blank">View</a>

                            <a class="btn red ng-cloak" ng-click="removeFile(formData)" ng-show="formData.image && formData.image != '' "><i class="fa fa-remove"></i></a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>How to Read</label>
                            
                            <trix-editor ng-model="formData.how_to_read" angular-trix></trix-editor>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">@{{(formData.id)?'Update':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>
</div>