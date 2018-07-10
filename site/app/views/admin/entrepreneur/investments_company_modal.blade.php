<div ng-if="loading_company_information">
	
	Loading....

</div>
<div ng-if="!loading_company_information">
	<div class="row ng-cloak">
		<div class="col-md-12">
			<div class="form-group">
				<label>Company Name<span class="required">*</span></label>
				<input type="text" ng-model="formData.company_information.company_name" class="form-control" >
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>Type of Social Enterprise</label>
				<select ng-model="formData.company_information.type_social_enterprise" class="form-control" convert-to-number>
					<option value="">Select</option>
					<option ng-repeat="type in social_enterprises" value="@{{type.id}}">@{{type.subtag_name}}</option>
				</select>
				<input ng-model="formData.company_information.type_social_enterprise_other" class="form-control other-text" ng-if="formData.company_information.type_social_enterprise == -1 " placeholder="Please enter value">
			</div>
		</div>
		
		<div class="col-md-12 clear">
			<div class="form-group">
				<label>Third Party Certifications (Can Select all that apply)</label>
				<select ng-model="formData.company_information.third_party_certification" class="form-control" multiple="true" >
                    <option ng-repeat="certificate in third_party_certifications" ng-value="certificate.id">@{{certificate.subtag_name}}</option>
                </select>
			</div>

		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>Other Third Party Certifications (not in the list)</label>
		 		<input ng-model="formData.company_information.third_party_certificates_other" class="form-control" placeholder="Separate by comma">
			</div>
		</div>
		
		<div class="col-md-12">
			<hr>
			<button class="btn blue" ng-click="saveInvestment()" ladda="formData.processing">Save</button>
		</div>

		
	</div>
	
</div>