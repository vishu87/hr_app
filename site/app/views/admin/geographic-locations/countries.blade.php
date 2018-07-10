<div ng-controller="CountryCtrl" ng-init="initials();" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Countries
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue" ng-click="add()">Add Country</button>
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th>Country</th>
                    <th>Continent</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="country in countries">
                    <td> @{{$index+1}}</td>
                    <td> @{{country.name}}</td>
                    <td> @{{country.continent_name}}</td>
                    <td>
                        <button class="btn yellow uppercase" ng-click="edit(country)" ladda="country.edit">Edit</button>
                        <button class="btn red-mint uppercase" ng-click="delete(country,$index)" ladda="country.delete"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Begin  Modal -->
    <div id="countries" class="modal bs-modal-sm fade in modal-overflow" data-width="790"  style="top: 250px !important;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(country_id != 0)?'Update':'Add'}} country</h4>
        </div>
        <div class="modal-body" >
            <form name="countryForm" ng-submit="onSubmit(countryForm.$valid)">
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label>Country Name <span class="error"> *</span></label>
                            <input type="text" ng-model="formData.name" class="form-control" required >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Continent <span class="error"> *</span></label>
                            <select class="form-control" convert-to-number ng-model="formData.continent_id">
                                <option>Select</option>
                                <option ng-repeat="continent in continents" value="@{{continent.id}}">@{{continent.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">@{{(country_id != 0)?'Update':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- End modal -->
       
</div>