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
	<button class="btn blue" ng-click="saveInvestment()" ladda="formData.processing">Save</button>
	<hr>
</div>