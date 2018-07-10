<div ng-controller="ContinentCtrl" ng-init="initials();" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Continents
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue" ng-click="add()">Add Continent</button>
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th>Continent</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="continent in continents">
                    <td> @{{$index+1}}</td>
                    <td> @{{continent.name}}</td>
                    <td>
                        <button class="btn yellow uppercase" ng-click="edit(continent)" ladda="continent.edit">Edit</button>
                        <button class="btn red-mint uppercase" ng-click="delete(continent,$index)" ladda="continent.delete"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Begin  Modal -->
    <div id="continents" class="modal bs-modal-sm fade in modal-overflow" style="top: 250px !important;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(continent_id != 0)?'Update':'Add'}} Continent</h4>
        </div>
        <div class="modal-body" >
            <form name="continentForm" ng-submit="onSubmit(continentForm.$valid)">
                <div class="form-group">
                    <input type="text" ng-model="formData.name" class="form-control" placeholder="Continent Name" required >
                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">@{{(continent_id != 0)?'Update':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- End modal -->
       
</div>