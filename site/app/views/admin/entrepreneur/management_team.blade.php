<div class="">
	<div class="team-row" ng-repeat="management in formData.managements track by $index">
		<div class="row">
			<div class="col-md-3" style="text-align: center;margin-bottom: 10px;">
				<div class="team-img" ng-show="management.image == '' || management.image == null">
	                <img src="{{url('/assets/img/avatar.png')}}">
	            </div>
	            <div class="team-img" ng-show="management.image && management.image != ''">
	                <img src="{{url('/')}}/@{{management.image}}">
	            </div>

	            <button type="button" ng-show="management.image == '' || management.image == null" class="button btn btn-xs upload-btn" ngf-select="uploadFile($file,'image',management)" ngf-max-size="5MB" ladda="management.uploading" >Select Image</button>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label ng-if="$index!=10000">First Name</label>
							<input type="text" placeholder="First Name" ng-model="management.management_first_name" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label ng-if="$index!=10000">Last Name</label>
							<input type="text" placeholder="Last Name" ng-model="management.management_last_name" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label ng-if="$index!=10000">Position</label>
							<input type="text" placeholder="Position" ng-model="management.position" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label ng-if="$index!=10000">LinkedIn Profile Link</label>
							<input type="text" placeholder="Linked In Profile" ng-model="management.linkedin_profile" class="form-control">
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<div>
	<div class="form-group">
		<button type="button" class="btn btn-sm yellow" ng-click="addMoreManagement()" type="button">
			<i class="fa fa-plus"></i>Add More
		</button>
	</div>
</div>
