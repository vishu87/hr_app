<div>
	<div class="row ng-cloak">
		<div class="col-md-6">
			<div class="form-group">
				<label>Company Name<span class="required">*</span></label>
				<input type="text" ng-model="formData.company_name" class="form-control" >
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Year Founded</label>
				<select ng-model="formData.company_foundation_year" convert-to-number class="form-control" >
					<option ng-repeat="year in years" value="@{{year.id}}">@{{year.year}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Website</label>
				<input type="text" ng-model="formData.website" class="form-control" >
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Employees</label>
				<input type="text" ng-model="formData.employees" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Type of Social Enterprise</label>
				<select ng-model="formData.type_social_enterprise" class="form-control" convert-to-number>
					<option value="">Select</option>
					<option ng-repeat="type in social_enterprises" value="@{{type.id}}">@{{type.subtag_name}}</option>
				</select>
				<input ng-model="formData.type_social_enterprise_other" class="form-control other-text" ng-if="formData.type_social_enterprise == -1 " placeholder="Please enter value">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Corporate Structure</label>
				<select ng-model="formData.corporate_structure" class="form-control" convert-to-number>
					<option value="">Select</option>
					<option ng-repeat="type in andorra_dropdowns.corporate_structure" value="@{{type.id}}">@{{type.subtag_name}}</option>
				</select>
				<input ng-model="formData.corporate_structure_other" class="form-control other-text" ng-if="formData.corporate_structure == -1 " placeholder="Please enter value">
			</div>
		</div>

		
		<div class="col-md-6 clear">
			<div class="form-group">
				<label>Third Party Certifications (Can Select all that apply)</label>
				<select ng-model="formData.third_party_certification" class="form-control" multiple="true" >
                    <option ng-repeat="certificate in third_party_certifications" ng-value="certificate.id">@{{certificate.subtag_name}}</option>
                </select>
			</div>

		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Other Third Party Certifications (not in the list)</label>
		 		<input ng-model="formData.third_party_certificates_other" class="form-control" placeholder="Separate by comma">
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<label>Mission Statement</label>
				<input type="text" ng-model="formData.mission_statement" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label>One Line Description</label>
				<input type="text" ng-model="formData.one_line_description" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label>Company Overview</label>
				<textarea class="form-control" ng-model="formData.overview"></textarea>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Actively Raising?</label>
				<select ng-model="formData.raising_capital" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="capital in andorra_dropdowns.raising_capitals" value="@{{capital.id}}">@{{capital.subtag_name}}</option>
				</select>
			</div>
		</div>
		
	</div>
	
</div>