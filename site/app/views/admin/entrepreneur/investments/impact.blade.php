<div>
	<div class="row ng-cloak">
		
		<div class="col-md-12">
			<h3 style="margin-bottom: 5px;" class="modal-title">Impact Area</h3>
			<div class="row" >
				<div class="col-md-4 form-group">
					<label>Type</label>
					<select ng-model="area_type" class="form-control" onChange="areaChange()" convert-to-number>
						<option ng-repeat="type in area_types" value="@{{type.id}}">@{{type.name}}</option>
					</select>
				</div>
				<div class="col-md-6">
					<div class="form-group" ng-show="area_type == 1">
						<label>Continents</label>
						<select ng-model="continent_geo_id" class="form-control" convert-to-number>
							<option ng-repeat="continent in continent_sub_tags" value="@{{continent.id}}">@{{continent.name}}</option>
						</select>
					</div>

					<div class="form-group" ng-show="area_type == 2">
						<label>Countries</label>
						<select ng-model="country_geo_id" class="form-control" convert-to-number>
							<option ng-repeat="country in country_sub_tags" value="@{{country.id}}">@{{country.name}}</option>
						</select>
					</div>

					<div class="form-group" ng-show="area_type == 3">
						<label>US States</label>
						<select ng-model="state_geo_id" class="form-control" convert-to-number>
							<option ng-repeat="state in state_sub_tags" value="@{{state.id}}">@{{state.name}}</option>
						</select>
					</div>

					<div class="form-group" ng-show="area_type == 4">
						<label>US City</label>
						<select ng-model="city_geo_id" class="form-control" convert-to-number>
							<option ng-repeat="city in city_sub_tags" value="@{{city.id}}">@{{city.name}}</option>
						</select>
					</div>

					<div class="form-group" ng-show="area_type == 5">
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
				<div class="col-md-2" ng-hide="!area_type">
					<button type="button" ng-click="addImpactArea()" class="btn blue" style="margin-top:25px">Add</button>
				</div>
			</div>
			<div ng-repeat="area in formData.areas" style="border:1px solid #EEE; padding: 10px; margin: 10px 10px 10px 0; display:inline-block">
				<div >
					@{{$index + 1}} @{{area.geo_name}} @{{area.address}} <button class="btn btn-xs" type="button" ng-click="removeImpactArea($index)" style="margin-left:5px"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<hr>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Impact Focus</label>
				<select ng-model="formData.impact_focus" class="form-control" convert-to-number>
					<option value="">Select</option>
					<option ng-repeat="focus in impact_focus" value="@{{focus.id}}">@{{focus.subtag_name}}</option>
				</select>
				<input ng-model="formData.details.impact_focus_other" class="form-control other-text" ng-if="formData.impact_focus == -1 " placeholder="Please enter value">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Impact Metrics (Text to Provide space)</label>
				<input type="text" ng-model="formData.impact_matrix" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<h3 style="margin-bottom: 5px;" class="modal-title">Impact Sectors</h3>
				
			<div class="row" ng-repeat="sector in formData.sectors">
				<div class="col-md-1 form-group">
					<h4 style="margin-top:30px">@{{$index + 1}}</h4>
				</div>
				<div class="col-md-3 form-group">
					<label>Sector</label>
					<select ng-model="sector.sector_id" class="form-control" convert-to-number>
						<option value="">Select</option>
						<option ng-repeat="sector in impact_sectors" value="@{{sector.id}}">@{{sector.subtag_name}}</option>
					</select>
					<input ng-model="sector.sector_other" class="form-control other-text" ng-if="sector.sector_id == -1 " placeholder="Please enter value">
				</div>
				<div class="col-md-7">
					<div class="row" ng-show="sector.sector_id != ''">
						<div class="col-md-6 form-group">
							<label>Industry 1</label>
							<select ng-model="sector.industry1_id" class="form-control" convert-to-number>
								<option value="">Select</option>
								<option ng-repeat="industry in impact_industries | filter:{sector_id : sector.sector_id}" value="@{{industry.id}}">@{{industry.subtag_name}}</option>
								<option value="-1">Other</option>
							</select>
							<input ng-model="sector.industry1_other" class="form-control other-text" ng-if="sector.industry1_id == -1 " placeholder="Please enter value">
						</div>
						<div class="col-md-6 form-group">
							<label>Industry 2</label>
							<select ng-model="sector.industry2_id" class="form-control" convert-to-number>
								<option value="">Select</option>
								<option ng-repeat="industry in impact_industries | filter:{sector_id : sector.sector_id}" value="@{{industry.id}}">@{{industry.subtag_name}}</option>
								<option value="-1">Other</option>
							</select>
							<input ng-model="sector.industry2_other" class="form-control other-text" ng-if="sector.industry2_id == -1 " placeholder="Please enter value">
						</div>
					</div>
				</div>
				<div class="col-md-1 form-group">
					<button class="btn btn-xs" type="button" ng-click="removeImpactSector($index)" style="margin-left:5px; margin-top: 30px;"><i class="fa fa-remove"></i></button>
				</div>
			</div>

			<div>
				<button type="button" class="btn btn-xs" ng-click="addMoreImpactSector()">Add More</button>
			</div>

			<hr>

		</div>

		<div class="col-md-12">
			<div class="form-group">
				<h3 style="margin-bottom: 5px;" class="modal-title">U.N. Sustainable Development Goals</h3>

				<div class="row" ng-repeat="goal in formData.goals">
					<div class="col-md-1" style="text-align: center;">
						<h4>@{{$index + 1}}</h4>
					</div>
					<div class="col-md-4 form-group">
						<select ng-model="goal.goal_id" class="form-control" convert-to-number>
							<option ng-repeat="goal in development_goals" value="@{{goal.id}}">@{{goal.subtag_name}}</option>
						</select>
						<input ng-model="goal.goal_other" class="form-control other-text" ng-if="goal.goal_id == -1 " placeholder="Please enter value">
					</div>
					<div class="col-md-1" style="text-align: center;">
						<button class="btn btn-xs" type="button" ng-click="removeImpactGoal($index)" style="margin-left:5px"><i class="fa fa-remove"></i></button>
					</div>
				</div>
				<div>
					<button type="button" class="btn btn-xs" ng-click="addMoreImpactGoal()">Add More</button>
				</div>
				<hr>
			</div>
		</div>

		<div class="col-md-12">
			<h3 style="margin-bottom: 5px;" class="modal-title">Impact Parameters</h3>
		</div>
			
		@foreach($form_impact_elements as $element)
		<div class="col-md-4">
			<div class="form-group">
				<label>{{$element["name"]}}</label>
				@if($element["type"] == 'select')
					<select ng-model="formData.{{$element['field']}}" class="form-control" convert-to-number>
						<option ng-repeat="item in impact_dropdowns.{{$element['dropdown']}}" value="@{{item.id}}">@{{item.subtag_name}}</option>
					</select>
				@endif

				@if($element["type"] == 'input')
					<input ng-model="formData.{{$element['field']}}" class="form-control" />
				@endif

				@if($element["type"] == 'multiple')
					<select ng-model="formData.{{$element['field']}}" class="form-control" multiple>
						<option ng-repeat="item in impact_dropdowns.{{$element['dropdown']}}" ng-value="item.id">@{{item.subtag_name}}</option>
					</select>
				@endif

			</div>
		</div>
		@endforeach

	</div>
	
</div>

<script>
	var lat_init = 0;
	var lng_init = 0;
	var map;

	google.maps.event.addDomListener(window, 'load', function(){
		var input = document.getElementById('searchTextField');
		var autocomplete = new google.maps.places.Autocomplete(input);

		google.maps.event.addListener(autocomplete, 'place_changed', function() {

			var place = autocomplete.getPlace();
		    var lat = place.geometry.location.lat();
		    var lng = place.geometry.location.lng();

		    var place = autocomplete.getPlace();
		    $("#address").val(place.formatted_address);
		    var lat = place.geometry.location.lat();
		    $("#lat").val(lat);
		    var lng = place.geometry.location.lng();
		    $("#lng").val(lng);

		    var latlng = new google.maps.LatLng(lat, lng);
		    marker.setPosition(latlng);
		    map.setCenter(latlng);
		});

	});

	var marker = new google.maps.Marker({draggable:true});
	google.maps.event.addListener(marker, 'dragend', function() {
	    var lat = marker.getPosition().lat();
	    $(".lat").val(lat);
	    var lng = marker.getPosition().lng();
	    $(".lng").val(lng);
	});

	var myCenter = new google.maps.LatLng(lat_init, lng_init);
	
	google.maps.event.addDomListener(window, 'load', function(){
		var map_prop = {
			center: myCenter,
			zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		};
		map = new google.maps.Map(document.getElementById("map"), map_prop);
		marker.setPosition(myCenter);
		marker.setMap(map);
	});

	function areaChange(){
		$("#map").animate({
            height : "250px",
        },1000,function(){
			google.maps.event.trigger(map, 'resize');
			var latlng = new google.maps.LatLng(lat_init, lng_init);
		    marker.setPosition(latlng);
		    map.setCenter(latlng);
        });
	}
</script>