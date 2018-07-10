<div ng-controller="CityCtrl" ng-init="initials();" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Cities
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue" ng-click="add()">Add City</button>
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th>City Name</th>
                    <th>State</th>
                    <th>Country</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="city in cities">
                    <td> @{{$index+1}}</td>
                    <td> @{{city.name}}</td>
                    <td> @{{city.state}}</td>
                    <td> @{{city.country}}</td>
                    <td>
                        <button class="btn yellow uppercase" ng-click="edit(city)" ladda="city.edit">Edit</button>
                        <button class="btn red-mint uppercase" ng-click="delete(city,$index)" ladda="city.delete"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Begin  Modal -->
    <div id="cities" class="modal bs-modal-sm fade in modal-overflow" data-width="790"  style="top: 250px !important;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(city_id != 0)?'Update':'Add'}} city</h4>
        </div>
        <div class="modal-body" >
            <form name="cityForm" ng-submit="onSubmit(cityForm.$valid)">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>City Name <span class="error"> *</span></label>
                            <input type="text" ng-model="formData.name" class="form-control" required >
                        </div>
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group" style="margin-top: 20px;">
                            <label>
                                <input type="radio" ng-value="1" ng-model="formData.in_us" ng-required="!formData.in_us" > &nbsp;Inside USA &nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                <input type="radio" ng-value="2" ng-model="formData.in_us" ng-required="!formData.in_us" > &nbsp;Outside USA 
                            </label>
                        </div>
                    </div>


                    <div class="col-md-6" ng-if="formData.in_us == 1">
                        <div class="form-group">
                            <label>US State <span class="error"> *</span></label>
                            <select class="form-control" convert-to-number ng-model="formData.state_id">
                                <option>Select</option>
                                <option ng-repeat="state in states" value="@{{state.id}}">@{{state.name}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6" ng-if="formData.in_us == 2">
                        <div class="form-group">
                            <label>Country<span class="error"> *</span></label>
                            <select class="form-control" convert-to-number ng-model="formData.country_id" required="required">
                                <option>Select</option>
                                <option ng-repeat="country in countries" value="@{{country.id}}">@{{country.name}}</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">@{{(city_id != 0)?'Update':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- End modal -->
       
</div>