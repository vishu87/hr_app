<div class="col-md-12">
	<div class="form-group">
		<h3 style="margin-bottom: 5px;" class="modal-title">Impact Area</h3>
		<div class="row" >
			<div class="col-md-4 form-group">
				<label>Type</label>
				<select ng-model="area_form.area_type" class="form-control" convert-to-number>
					<option ng-repeat="type in area_types" value="@{{type.id}}">@{{type.name}}</option>
				</select>
			</div>
			<div class="col-md-6">
				<div class="form-group" ng-show="area_form.area_type == 1" >
					<label>Continents</label>
					<select ng-model="area_form.continent_geo_id" class="form-control" convert-to-number>
						<option ng-repeat="continent in continent_sub_tags" value="@{{continent.id}}">@{{continent.name}}</option>
					</select>
				</div>

				<div class="form-group" ng-show="area_form.area_type == 2" >
					<label>Countries</label>
					<select ng-model="area_form.country_geo_id" class="form-control" convert-to-number>
						<option ng-repeat="country in country_sub_tags" value="@{{country.id}}">@{{country.name}}</option>
					</select>
				</div>

				<div class="form-group" ng-show="area_form.area_type == 3" >
					<label>US States</label>
					<select ng-model="area_form.state_geo_id" class="form-control" convert-to-number>
						<option ng-repeat="state in state_sub_tags" value="@{{state.id}}">@{{state.name}}</option>
					</select>
				</div>

				<div class="form-group" ng-show="area_form.area_type == 4" >
					<label>US City</label>
					<select ng-model="area_form.city_geo_id" class="form-control" convert-to-number>
						<option ng-repeat="city in city_sub_tags" value="@{{city.id}}">@{{city.name}}</option>
					</select>
				</div>

				<div class="form-group" ng-show="area_form.area_type == 5">
					<label>Specific Location</label>
					<div class="row">
						<div class="col-md-12">
							<input id="searchTextField" type="text" style="width: 100%; padding: 5px; margin-bottom: 10px;">
							<div>
								<div class="form-group">
									<label>Latitude</label>
									<input type="text" class="form-control lat" id="lat">
								</div>
								<div class="form-group">
									<label>Longitude</label>
									<input type="text" class="form-control lng" id="lng">
								</div>
								<div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control address" id="address">
								</div>
							</div>
						</div>

						<div class="col-md-12" style="margin-bottom: 20px;">
							<div id="map" style="width: 100%; height: 200px"></div>
							<small>Search for a venue and then drag the marker to adjust it</small>
						</div>
					
					</div>
				</div>
			</div>
			<div class="col-md-2" ng-hide="!area_form.area_type">
				<button type="button" ng-click="addImpactArea(area_type)" class="btn blue" style="margin-top:25px">Add</button>
			</div>
		</div>
		<div ng-repeat="area in formData.areas" style="border:1px solid #EEE; padding: 10px; margin: 10px 10px 10px 0; display:inline-block">
			<div >
				@{{$index + 1}} @{{area.geo_name}} @{{area.address}} <button class="btn btn-xs" type="button" ng-click="removeImpactArea($index)" style="margin-left:5px"><i class="fa fa-remove"></i></button>
			</div>
		</div>
		<hr>
		<button class="btn blue" ng-click="saveInvestment()" ladda="formData.processing">Save</button>
		<hr>
	</div>
</div>
