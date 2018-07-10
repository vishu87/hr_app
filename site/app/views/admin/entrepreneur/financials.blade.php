<div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>Actively Raising: In the near future?</label>
				<select ng-model="financial.raising_capital" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="capital in financial_dropdowns.raising_capitals" value="@{{capital.id}}">@{{capital.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Product Name</label>
				<input type="text" ng-model="financial.product_name" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Limited to Accredited Investors</label>
				<select ng-model="financial.accredited_investor" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="accredited_investor in financial_dropdowns.acredited_investors" value="@{{accredited_investor.id}}">@{{accredited_investor.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Amount of Capital Seeking</label>
				<input type="text" ng-model="financial.amount_seeking" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Amount Raised</label>
				<input type="text" ng-model="financial.amount_raised" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Asset Class</label>
				<select ng-model="financial.asset_class" class="form-control"  convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="asset in financial_dropdowns.assets" value="@{{asset.id}}">@{{asset.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Sub Asset Class</label>
				<select ng-model="financial.sub_asset_class" class="form-control"  convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="sub_asset in financial_dropdowns.sub_assets" value="@{{sub_asset.id}}">@{{sub_asset.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Financial Instrument</label>
				<select ng-model="financial.financial_instruments" class="form-control"  convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="instrument in financial_dropdowns.financial_instruments" value="@{{instrument.id}}">@{{instrument.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6 form-group">
			<label>Other Information</label><br>
			<button type="button" ng-show="financial.other_info == '' || financial.other_info == null" class="button btn upload-btn" ngf-select="uploadInvestorFile($file,'other_info',financial)" ngf-max-size="5MB" ladda="other_info" data-style="expand-right" >Select Document</button>

            <a class="btn blue ng-cloak" href="{{url('/')}}/@{{financial.other_info}}" ng-show=" financial.other_info != null && financial.other_info != ''  " target="_blank">View</a>

            <a class="btn red ng-cloak" ng-click="removeInvestorFile(financial,'other_info')" ng-show=" financial.other_info != null && financial.other_info != ''  "><i class="fa fa-remove"></i></a>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Time Horizon (Years)</label>
				<input type="text" ng-model="financial.time_horizon_year" class="form-control" >
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Financial Return Expectations</label>
				<select ng-model="financial.financial_return_expect" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="return in financial_dropdowns.financial_returns" value="@{{return.id}}">@{{return.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Annual Return (past 12 months)</label>
				<input type="text" ng-model="financial.annual_return" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Target IRR</label>
				<input type="text" ng-model="financial.target_irr" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Average Investment Size</label>
				<input type="text" ng-model="financial.average_investment" class="form-control">
				
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Minimum Investment Size</label>
				<input type="text" ng-model="financial.minimum_investment_size" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Track Record</label>
				<input type="text" ng-model="financial.track_record" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Stage of Development</label>
				<select ng-model="financial.development_stage" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="stage in financial_dropdowns.development_stages" value="@{{stage.id}}">@{{stage.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Relevant Benchmark</label>
				<select ng-model="financial.relevant_benchmark" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="benchmark in financial_dropdowns.relevant_benchmarks" value="@{{benchmark.id}}">@{{benchmark.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Total Assets</label>
				<input type="text" ng-model="financial.total_assets" class="form-control">
				
			</div>
		</div>

	</div>
	
</div>