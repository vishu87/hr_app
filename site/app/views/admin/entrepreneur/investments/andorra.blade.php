<div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Portfolio Objective</label>
				<select ng-model="formData.portfolio_objective" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="portfolio in andorra_dropdowns.portfolios" value="@{{portfolio.id}}">@{{portfolio.subtag_name}}</option>
				</select>
			</div>
		</div>


		<div class="col-md-6">
			<div class="form-group">
				<label>Impact Objective </label>
				<select ng-model="formData.impact_objective" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="objective in andorra_dropdowns.impact_objectives" value="@{{objective.id}}">@{{objective.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Degree Of Separation</label>
				<select ng-model="formData.degree_sepration" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="degree in andorra_dropdowns.degree_seprations" value="@{{degree.id}}">@{{degree.subtag_name}}</option>
				</select>
				<input ng-model="formData.details.degree_sepration_other" class="form-control other-text" ng-if="formData.degree_sepration == -1 " placeholder="Please enter value">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Risk Profile</label>
				<select ng-model="formData.risk_profile" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="risk in andorra_dropdowns.risk_profiles" value="@{{risk.id}}">@{{risk.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Risk Score </label>
				<select ng-model="formData.risk_score" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="score in andorra_dropdowns.risk_scores" value="@{{score.id}}">@{{score.subtag_name}}</option>
				</select>
			</div>
		</div>


		<div class="col-md-6">
			<div class="form-group">
				<label>Impact Class </label>
				<select ng-model="formData.impact_class" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="class in andorra_dropdowns.impact_classes" value="@{{class.id}}">@{{class.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Status</label>
				<select ng-model="formData.status" class="form-control" convert-to-number>
					<option ng-repeat="stat in andorra_dropdowns.status" value="@{{stat.id}}">@{{stat.name}}</option>
				</select>
			</div>
		</div>

	</div>

	<hr>
	<h4 class="modal-title">Auto Update fields</h4>
	<hr>

	<div class="row">
		
		<div class="col-md-6">
			<div class="form-group">
				<label>Liquidity Preference</label>
				<select ng-model="formData.time_horizon_tag" ng-disabled="true" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="horizon in financial_dropdowns.time_horizons" value="@{{horizon.id}}">@{{horizon.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Target IRR</label>
				<select ng-model="formData.target_irr_tag" ng-disabled="true" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="return in financial_dropdowns.financial_returns" value="@{{return.id}}">@{{return.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Average Investment Size</label>
				<select ng-model="formData.average_investment_tag" ng-disabled="true" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="investment in financial_dropdowns.average_investments" value="@{{investment.id}}">@{{investment.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Track Record</label>
				<select ng-model="formData.track_record_tag" ng-disabled="true" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="record in financial_dropdowns.track_records" value="@{{record.id}}">@{{record.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Total Assets</label>
				<select ng-model="formData.total_assets_tag" ng-disabled="true" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="asset in financial_dropdowns.total_assets" value="@{{asset.id}}">@{{asset.subtag_name}}</option>
				</select>
			</div>
		</div>
	</div>
</div>