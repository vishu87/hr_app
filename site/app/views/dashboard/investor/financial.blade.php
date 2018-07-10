<style type="text/css">
	.andorra-bar {
		margin-top: -30px;
		text-align: center;
	}
</style>

<div class="row ">
	<div class="col-md-5">
		<table class="table return-table hidden">
			<tr ng-repeat="data in overall_portfolio_return">
				<td>@{{data.name}}</td>
				<td style="text-align: center;">@{{data.value}}</td>
			</tr>
		</table>
		<div class="fin-stat">
			<h4>Portfolio</h4>
			<div>$11,000,000</div>
			<h4>Overall Portfolio return (YTD)</h4>
			<div>10%</div>
		</div>
	</div>
	<div class="col-md-7">
		<div e-line-chart dataid="overall" dataname="Overall Portfolio Return" datagraph = "overall_portfolio_return" ng-if="financial_report" class="andorra-bar"></div>
	</div>
</div>

<div style="margin-top: 50px; position: relative;">
	<div class="">
		<h2 class="impact-heading">Portfolio Allocation</h2>
		<div style="width: 300px; float: left;">
			<div e-pie-chart dataid="major_asset_class_current" dataname="Current" datagraph = "major_asset_class_current" ng-if="major_asset_class_current" class="andorra-chart" style="height: 300px"></div>
		</div>
		<div style="width: 300px; float: right;">
			<div e-pie-chart dataid="major_asset_class_target" dataname="Target" datagraph = "major_asset_class_target" ng-if="major_asset_class_target" class="andorra-chart" style="height: 300px"></div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<div ng-repeat="major_asset in major_assets" class="major-asset asset-@{{$index + 1}}">
	 	<div class="table-return head" ng-click="major_asset.open = !major_asset.open" style="cursor: pointer;">
			<div style="width: 20%" >
				<span>
					<i class="fa fa-angle-right" ng-show="!major_asset.open"></i>
	 				<i class="fa fa-angle-down" ng-show="major_asset.open"></i>
	 				@{{major_asset.current_allocation}}.00%
				</span>
			</div>
			<div style="width: 60%" class="tcenter">
				<span style="display: inline-block; width: 150px; margin-right: 30px" class="tright">@{{major_asset.name}}</span>
				<span style="display: inline-block; width: 150px;" class="tleft">$@{{major_asset.market_value}}.00</span>
			</div>
			<div style="width: 20%" class="tcenter">
				@{{major_asset.target_allocation}}.00%
			</div>
		</div>
		<div class="assets" ng-show="major_asset.open">
			<div class="table-return asset-head">
				<div style="width: 200px">Asset Class</div>
				<div style="width: 80px" class="tcenter">Target</div>
				<div style="width: 80px" class="tcenter">Current</div>
				<div style="width: 300px"></div>
				<div style="width: 150px" class="tright">Market Value</div>
				<div style="width: 100px" class="tcenter">Return</div>
			</div>
			<div class="asset">
				<div ng-repeat="asset in major_asset.assets">
					<div class="table-return">
						<div style="width: 200px" ng-click="asset.open = !asset.open">
							<span style="cursor: pointer;">
								<i class="fa fa-angle-right" ng-show="!asset.open"></i>
								<i class="fa fa-angle-down" ng-show="asset.open"></i>
								@{{asset.name}}
							</span>
						</div>
						<div style="width: 80px" class="tcenter">@{{asset.target_allocation}}.00%</div>
						<div style="width: 80px" class="tcenter">@{{asset.current_allocation}}.00%</div>
						<div style="width: 300px">
							<div class="fin-bar" style="width: @{{asset.current_allocation*10/5}}%; opacity: @{{asset.current_allocation*2/100}}"></div>
							<span style="font-size: 12px">@{{asset.current_allocation}}%</span>
						</div>
						<div style="width: 150px" class="tright">$@{{asset.market_value}}.00</div>
						<div style="width: 100px" class="tcenter">@{{asset.ytd}}.00%</div>
					</div>
					<div class="sub-assets" ng-show="asset.open">
						<div ng-repeat="sub_asset in asset.sub_assets">
							<div class="table-return" style="color: #555; font-size: 14px;">
								<div style="width: 200px" ng-click="sub_asset.open = !sub_asset.open">
									<span style="padding-left: 20px; display: inline-block; cursor: pointer;">
										<i class="fa fa-angle-right" ng-show="!sub_asset.open"></i>
										<i class="fa fa-angle-down" ng-show="sub_asset.open"></i>
										@{{sub_asset.name}}
									</span>
								</div>
								<div style="width: 80px" class="tcenter">@{{sub_asset.target_allocation}}.00%</div>
								<div style="width: 80px" class="tcenter">@{{sub_asset.current_allocation}}.00%</div>
								<div style="width: 300px">
									<div class="fin-bar" style="width: @{{sub_asset.current_allocation*10/5}}%; opacity: @{{sub_asset.current_allocation*2/100}}"></div>
									<span style="font-size: 12px">@{{sub_asset.current_allocation}}%</span>
								</div>
								<div style="width: 150px" class="tright">$@{{sub_asset.market_value}}.00</div>
								<div style="width: 100px" class="tcenter">@{{sub_asset.ytd}}.00%</div>
							</div>
							<div class="investments" ng-show="sub_asset.open">
								<div ng-repeat="investment in sub_asset.investments">
									<div class="table-return" style="color: #1d5fb3; font-size: 13px;">
										<div style="width: 280px">
											<span style="padding-left: 60px; display: inline-block;">@{{investment.name}}</span>
										</div>
										<div style="width: 80px" class="tcenter">@{{investment.current_allocation}}.00%
										</div>
										<div style="width: 300px">
											<div class="fin-bar" style="width: @{{investment.current_allocation*10/5}}%; opacity: @{{investment.current_allocation*2/100}}"></div>
											<span style="font-size: 12px">@{{investment.current_allocation}}%</span>
										</div>
										<div style="width: 150px" class="tright">$@{{investment.market_value}}.00</div>
										<div style="width: 100px" class="tcenter">@{{investment.ytd}}.00%</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>