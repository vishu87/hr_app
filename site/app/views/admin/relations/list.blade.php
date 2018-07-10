<div ng-controller="relationCtrl" ng-init="initials()" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Relations
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue" ng-click="addRelation()">Add Relation</button>
        </div>
    </div>
    
    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th> ID </th>
                    <th> Relation </th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="relation in relations">
                    <td> @{{$index+1}}</td>
                    <td> @{{relation.id}}</td>
                    <td> @{{relation.relation_name}} </td>
                    <td>
                        <button class="btn yellow uppercase" ng-click="editRelation(relation)">Edit</button>

                        <a class="btn blue uppercase" href="{{url('/relations/addLink')}}/@{{relation.id}}">Links</a>

                        <button class="btn red-mint uppercase" ng-click="deleteRelation(relation,$index)" ladda="relation.processing"><i class="fa fa-remove"></i></button>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="relations" class="modal bs-modal-sm fade in modal-overflow">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(relation_id != 0)?'Update':'Add'}} relation</h4>
        </div>
        <div class="modal-body" >
            <form name="RelationForm" ng-submit="onSubmit(RelationForm.$valid)">
                <div class="form-group">
                    <input type="text" ng-model="relationData.relation_name" class="form-control" placeholder="Relation Name" required >
                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">@{{(relation_id != 0)?'Update':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>

</div>