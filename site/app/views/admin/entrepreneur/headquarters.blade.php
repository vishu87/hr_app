<div>
	<hr>
	<h4>
		Headquarter Location
	</h4>

	<div class="row">
		<div class="col-md-6">
			<input id="searchTextField" type="text" style="width: 100%; padding: 5px; margin-bottom: 10px;">
			<div>
				<div class="form-group">
					<label>Latitude</label>
					<input type="text" ng-model="formData.headquarter.latitude" class="form-control lat" >
				</div>
				<div class="form-group">
					<label>Longitude</label>
					<input type="text" ng-model="formData.headquarter.longitude" class="form-control lng" >
				</div>
			</div>
		</div>

		<div class="col-md-6" style="margin-bottom: 20px;">
			<div id="map" style="width: 100%; height: 200px"></div>
			<small>Search for a venue and then drag the marker to adjust it</small>
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Address</label>
				<input type="text" ng-model="formData.headquarter.address" class="form-control address">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Address (Other details)</label>
				<input type="text" ng-model="formData.headquarter.address_2" class="form-control address">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>City</label>
				<input type="text" ng-model="formData.headquarter.city" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>State</label>
				<input type="text" ng-model="formData.headquarter.state" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Zip</label>
				<input type="text" ng-model="formData.headquarter.zip" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Country</label>
				<input type="text" ng-model="formData.headquarter.country" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="col-md-6">
			<div class="form-group">
				<label>Contact First Name</label>
				<input type="text" ng-model="formData.headquarter.contact_first_name" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Contact Last Name</label>
				<input type="text" ng-model="formData.headquarter.contact_last_name" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Contact Email</label>
				<input type="text" class="form-control" ng-model="formData.headquarter.contact_email">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Contact Phone Number</label>
				<input type="text" class="form-control" ng-model="formData.headquarter.contact_phone_number">
			</div>
		</div>
	</div>
</div>

<script>
	var lat_init = '{{(isset($latitude)?$latitude:0)}}';
	var lng_init = '{{(isset($longitude)?$longitude:0)}}';
	var map;

	google.maps.event.addDomListener(window, 'load', function(){
		var input = document.getElementById('searchTextField');
		var autocomplete = new google.maps.places.Autocomplete(input);

		google.maps.event.addListener(autocomplete, 'place_changed', function() {

			var place = autocomplete.getPlace();
		    var lat = place.geometry.location.lat();
		    var lng = place.geometry.location.lng();

			var scope = angular.element($(".address")).scope(); // just getting scope variable

			if(!scope.formData.headquarter){
				scope.formData.headquarter = {};
			}

		    scope.$apply(function(){
		        scope.formData.headquarter.latitude = lat;
		        scope.formData.headquarter.longitude = lng;
		        scope.formData.headquarter.address = place.formatted_address;
		    });

		    // var place = autocomplete.getPlace();
		    // $(".address").val(place.formatted_address);
		    // var lat = place.geometry.location.lat();
		    // $(".lat").val(lat);
		    // var lng = place.geometry.location.lng();
		    // // $(".lng").val(lng);

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
</script>