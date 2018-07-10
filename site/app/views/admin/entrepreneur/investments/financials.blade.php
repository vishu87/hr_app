<div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Product Name <span class="error">*</span></label>
				<input type="text" ng-model="formData.product_name" class="form-control" required="required">
			</div>
		</div>


		

		<div class="col-md-6">
			<div class="form-group">
				<label>Limited to Accredited Investors</label>
				<select ng-model="formData.accredited_investor" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="accredited_investor in financial_dropdowns.acredited_investors" value="@{{accredited_investor.id}}">@{{accredited_investor.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Website</label>
				<input type="text" ng-model="formData.website" class="form-control">
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label>Amount of Capital Seeking</label>
				<input type="text" ng-model="formData.amount_seeking" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label>Amount Raised so far</label>
				<input type="text" ng-model="formData.amount_raised" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
			</div>
		</div>

		<div class="col-md-6 clear">
			<div class="form-group">
				<label>Asset Class (Formerly Major Asset Class)</label>
				<select ng-model="formData.major_asset_class" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="asset in andorra_dropdowns.major_assets" value="@{{asset.id}}">@{{asset.subtag_name}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Sub Asset Class (Formerly Asset Class)</label>
				<select ng-model="formData.asset_class" class="form-control"  convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="asset in financial_dropdowns.assets | filter : { major_asset_id : formData.major_asset_class }" value="@{{asset.id}}">@{{asset.subtag_name}}</option>
					<option value="-1">Other</option>
				</select>
				<input ng-model="formData.details.asset_class_other" class="form-control other-text" ng-if="formData.asset_class == -1 " placeholder="Please enter value">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Impact Asset Class</label>
				<select ng-model="formData.sub_asset_class" class="form-control"  convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="sub_asset in financial_dropdowns.sub_assets | filter : { asset_id : formData.asset_class }" value="@{{sub_asset.id}}">@{{sub_asset.subtag_name}}</option>
					<option value="-1">Other</option>
				</select>
				<input ng-model="formData.details.sub_asset_class_other" class="form-control other-text" ng-if="formData.sub_asset_class == -1 " placeholder="Please enter value">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Financial Instrument</label>
				<select ng-model="formData.financial_instruments" class="form-control"  convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="instrument in financial_dropdowns.financial_instruments" value="@{{instrument.id}}">@{{instrument.subtag_name}}</option>
				</select>
				<input ng-model="formData.details.financial_instruments_other" class="form-control other-text" ng-if="formData.financial_instruments == -1 " placeholder="Please enter value">
			</div>
		</div>

		<div class="col-md-6 form-group clear">
			<label>Other Information</label><br>
			<button type="button" ng-show="formData.other_info == '' || formData.other_info == null" class="button btn upload-btn" ngf-select="uploadFile($file,'other_info')" ngf-max-size="5MB" ladda="formData.uploading" data-style="expand-right" >Select Document</button>

            <a class="btn blue ng-cloak" href="{{url('/')}}/@{{formData.other_info}}" ng-show=" formData.other_info != null && formData.other_info != ''  " target="_blank">View</a>

            <a class="btn red ng-cloak" ng-click="removeFile('other_info')" ng-show=" formData.other_info != null && formData.other_info != ''  "><i class="fa fa-remove"></i></a>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label style="display:block">Time Horizon</label>
				<input type="text" ng-model="formData.time_horizon_year_y" class="form-control " style="width:50px; display:inline-block" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt"> Years
				<input type="text" ng-model="formData.time_horizon_year_m" class="form-control " style="width:50px; display:inline-block" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt"> Months 
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Financial Return Expectations (vs Benchmark)</label>
				<select ng-model="formData.financial_return_expect" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="return in financial_dropdowns.financial_returns" value="@{{return.id}}">@{{return.subtag_name}}</option>
				</select>

			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Annual Return (past 12 months)</label>
				<input type="text" ng-model="formData.annual_return" class="form-control" ng-pattern = "/^([0-9.]*)$/" ng-pattern-err-type = "patternFloat">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Projected Financial Return (annual)</label>
				<input type="text" ng-model="formData.target_irr" class="form-control" ng-pattern = "/^([0-9.]*)$/" ng-pattern-err-type = "patternFloat">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Average Investment Size</label>
				<input type="text" ng-model="formData.average_investment" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
				
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Minimum Investment Size</label>
				<input type="text" ng-model="formData.minimum_investment_size" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Track Record</label>
				<input type="text" ng-model="formData.track_record" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group clear">
				<label>Stage of Development</label>
				<select ng-model="formData.development_stage" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="stage in financial_dropdowns.development_stages" value="@{{stage.id}}">@{{stage.subtag_name}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Relevant Benchmark</label>
				<select ng-model="formData.relevant_benchmark" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="benchmark in financial_dropdowns.relevant_benchmarks" value="@{{benchmark.id}}">@{{benchmark.subtag_name}}</option>
				</select>
				<input ng-model="formData.details.relevant_benchmark_other" class="form-control other-text" ng-if="formData.relevant_benchmark == -1 " placeholder="Please enter value">
			</div>
		</div>
		<div class="col-md-6 clear">
			<div class="form-group">
				<label>Total Assets</label>
				<input type="text" ng-model="formData.total_assets" class="form-control" ng-pattern = "/^(0|[1-9][0-9]*)$/" ng-pattern-err-type = "patternInt">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Currency</label>
				<select ng-model="formData.currency_id" class="form-control" convert-to-number>
					<option ng-value="">Select</option>
					<option ng-repeat="currency in financial_dropdowns.currencies" value="@{{currency.id}}">@{{currency.subtag_name}}</option>
				</select>

			</div>
		</div>

	</div>

	<div class="row">
		@foreach($form_financial_elements as $element)
		<div class="col-md-6">
			<div class="form-group">
				<label>{{$element["name"]}}</label>
				@if($element["type"] == 'select')
					<select ng-model="formData.{{$element['field']}}" class="form-control" convert-to-number>
						<option ng-repeat="item in financial_dropdowns.{{$element['dropdown']}}" value="@{{item.id}}">@{{item.subtag_name}}</option>
					</select>
				@endif

				@if($element["type"] == 'input')
					<input ng-model="formData.{{$element['field']}}" class="form-control" />
				@endif

				@if($element["type"] == 'multiple')
					<select ng-model="formData.{{$element['field']}}" class="form-control" multiple>
						<option ng-repeat="item in financial_dropdowns.{{$element['dropdown']}}" ng-value="item.id">@{{item.subtag_name}}</option>
					</select>
				@endif

			</div>
		</div>
		@endforeach
	</div>
	
</div>