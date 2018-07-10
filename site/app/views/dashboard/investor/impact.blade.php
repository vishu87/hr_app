<div>
	<table class="table">
		<thead>
			<tr>
				<th style="width: 300px"></th>
				<th>YTD</th>
				<th>2016</th>
				<th>2015</th>
				<th>2014</th>
				<th>Since Inception</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Cash Disbursed as Grants</td>
				<td>$10,000</td>
				<td>$1,000,000</td>
				<td>$800,000</td>
				<td>$750,000</td>
				<td>$10,000,000</td>
			</tr>
			<tr>
				<td>Cash Reserved as Grants</td>
				<td>$10,000</td>
				<td>$1,000,000</td>
				<td>$800,000</td>
				<td>$750,000</td>
				<td>$10,000,000</td>
			</tr>
		</tbody>
	</table>
	<table class="table">
		<thead>
			<tr>
				<th style="width: 300px">Program Related Investements</th>
				<th>YTD</th>
				<th>2016</th>
				<th>2015</th>
				<th>2014</th>
				<th>Since Inception</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Investment Dollars ($)</td>
				<td>$10,000</td>
				<td>$1,000,000</td>
				<td>$800,000</td>
				<td>$750,000</td>
				<td>$10,000,000</td>
			</tr>
			<tr>
				<td>Dollars Recylced ($)</td>
				<td>$10,000</td>
				<td>$1,000,000</td>
				<td>$800,000</td>
				<td>$750,000</td>
				<td>$10,000,000</td>
			</tr>
		</tbody>
	</table>
</div>

<div style="margin-top: 50px; position: relative;">
	<div class="">
		<h2 class="impact-heading">Impact Sectors</h2>
		<div style="width: 300px; float: left;">
			<div e-pie-chart dataid="impact_sectors_current" dataname="Current" datagraph = "impact_sectors_current" ng-if="impact_sectors_current" class="andorra-chart" style="height: 300px"></div>
			
		</div>
		<div style="width: 300px; float: right;">
			<div e-pie-chart dataid="impact_sectors_target" dataname="Target" datagraph = "impact_sectors_target" ng-if="impact_sectors_target" class="andorra-chart" style="height: 300px"></div>
			
		</div>
		<div style="clear: both;"></div>
	</div>
	<div ng-repeat="sector in impact.sectors" class="major-asset asset-@{{$index + 1}}">
	 	<div class="table-return head" ng-click="sector.open = !sector.open" style="cursor: pointer;">
			<div style="width: 20%" >
				<span>
					<i class="fa fa-angle-right" ng-show="!sector.open"></i>
	 				<i class="fa fa-angle-down" ng-show="sector.open"></i>
	 				@{{sector.current_allocation}}.00%
				</span>
			</div>
			<div style="width: 60%" class="tcenter">
				<span style="display: inline-block; width: 190px; margin-right: 30px" class="tright">@{{sector.name}}</span>
				<span style="display: inline-block; width: 190px;" class="tleft">$@{{sector.market_value}}.00</span>
			</div>
			<div style="width: 20%" class="tcenter">
				@{{sector.target_allocation}}.00%
			</div>
		</div>
		<div class="assets" ng-show="sector.open">
			<div class="table-return asset-head">
				<div style="width: 200px">Industry</div>
				<div style="width: 80px" class="tcenter">Target</div>
				<div style="width: 80px" class="tcenter">Current</div>
				<div style="width: 300px"></div>
				<div style="width: 150px" class="tright">Market Value</div>
			</div>
			<div class="asset">
				<div ng-repeat="industry in sector.industries">
					<div class="table-return">
						<div style="width: 200px" ng-click="industry.open = !industry.open">
							<span style="cursor: pointer;">
								@{{industry.name}}
							</span>
						</div>
						<div style="width: 80px" class="tcenter">@{{industry.target_allocation}}.00%</div>
						<div style="width: 80px" class="tcenter">@{{industry.current_allocation}}.00%</div>
						<div style="width: 300px">
							<div class="fin-bar" style="width: @{{industry.current_allocation*10/5}}%; opacity: @{{industry.current_allocation*2/100}}"></div>
							<span style="font-size: 12px">@{{industry.current_allocation}}%</span>
						</div>
						<div style="width: 150px" class="tright">$@{{industry.market_value}}.00</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div style="margin-top: 50px; position: relative;">
	<div class="">
		<h2 class="impact-heading">UN SDG</h2>
		<div style="width: 300px; float: left;">
			<div e-pie-chart dataid="goals_current" dataname="Current" datagraph = "goals_current" ng-if="goals_current" class="andorra-chart" style="height: 300px"></div>
			
		</div>
		<div style="width: 300px; float: right;">
			<div e-pie-chart dataid="goals_target" dataname="Target" datagraph = "goals_target" ng-if="goals_target" class="andorra-chart" style="height: 300px"></div>
			
		</div>
		<div style="clear: both;"></div>
	</div>

	<div class="assets">
		<div class="table-return asset-head">
			<div style="width: 200px">UN SDG</div>
			<div style="width: 80px" class="tcenter">Target</div>
			<div style="width: 80px" class="tcenter">Current</div>
			<div style="width: 300px"></div>
			<div style="width: 150px" class="tright">Market Value</div>
		</div>
		<div class="asset">
			<div ng-repeat="goal in sdg.goals">
				<div class="table-return">
					<div style="width: 200px">
						<span style="cursor: pointer;">
							@{{goal.name}}
						</span>
					</div>
					<div style="width: 80px" class="tcenter">@{{goal.target_allocation}}.00%</div>
					<div style="width: 80px" class="tcenter">@{{goal.current_allocation}}.00%</div>
					<div style="width: 300px">
						<div class="fin-bar" style="width: @{{goal.current_allocation*10/5}}%; opacity: @{{goal.current_allocation*2/100}}"></div>
						<span style="font-size: 12px">@{{goal.current_allocation}}%</span>
					</div>
					<div style="width: 150px" class="tright">$@{{goal.market_value}}.00</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div style="margin-top: 50px; position: relative;">
	<div class="">
		<h2 class="impact-heading">Geograpchic Preference</h2>
		<div style="width: 300px; float: left;">
			<div e-pie-chart dataid="areas_current" dataname="Current" datagraph = "areas_current" ng-if="areas_current" class="andorra-chart" style="height: 300px"></div>
			
		</div>
		<div style="width: 300px; float: right;">
			<div e-pie-chart dataid="areas_target" dataname="Target" datagraph = "areas_target" ng-if="areas_target" class="andorra-chart" style="height: 300px"></div>
			
		</div>
		<div style="clear: both;"></div>
	</div>

	<div class="assets">
		<div class="table-return asset-head">
			<div style="width: 200px">Area</div>
			<div style="width: 80px" class="tcenter">Target</div>
			<div style="width: 80px" class="tcenter">Current</div>
			<div style="width: 300px"></div>
			<div style="width: 150px" class="tright">Market Value</div>
		</div>
		<div class="asset">
			<div ng-repeat="area in geo_preference.areas">
				<div class="table-return">
					<div style="width: 200px">
						<span style="cursor: pointer;">
							@{{area.name}}
						</span>
					</div>
					<div style="width: 80px" class="tcenter">@{{area.target_allocation}}.00%</div>
					<div style="width: 80px" class="tcenter">@{{area.current_allocation}}.00%</div>
					<div style="width: 300px">
						<div class="fin-bar" style="width: @{{area.current_allocation*10/7}}%; opacity: @{{area.current_allocation*2/100}}"></div>
						<span style="font-size: 12px">@{{area.current_allocation}}%</span>
					</div>
					<div style="width: 150px" class="tright">$@{{area.market_value}}.00</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div style="margin-top: 50px;">
	<table class="table">
		<thead>
			<tr>
				<th>Customized Company Metrics</th>
				<th>2016</th>
				<th>2015</th>
				<th>2014</th>
				<th>Since Inception</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Farmers Supported (#)</td>
				<td>120</td>
				<td>60</td>
				<td>30</td>
				<td>210</td>
			</tr>
			<tr>
				<td>Acres Converted (#)</td>
				<td>1800</td>
				<td>540</td>
				<td>150</td>
				<td>2490</td>
			</tr>
			<tr>
				<td>Greenhouse gas Emissions Reduced (# in tonnes)</td>
				<td>20400</td>
				<td>6120</td>
				<td>1700</td>
				<td>28220</td>
			</tr>
			<tr>
				<td>Annual Impact Reports</td>
				<td>
					<a href="#"><i class="fa fa-file-o"></i> 2016 Impact Report</a>
				</td>
				<td>
					<a href="#"><i class="fa fa-file-o"></i> 2015 Impact Report</a>
				</td>
				<td>
					<a href="#"><i class="fa fa-file-o"></i> 2014 Impact Report</a>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>

<div style="margin-bottom: 50px; margin-top: 50px;" class="text-center">
    <a href="{{url('assets/files/Andorra_Impact_Report.pdf')}}" class="btn btn-lg green" target="_blank" style="width: 300px">
        <i class="fa fa-file-pdf-o" style="color:#fff"></i> Generate Impact Report PDF
    </a>
</div>

<div style="margin-bottom: 100px;" class="text-center">
    <a href="{{url('/investor/impact-report-beta')}}" class="btn btn-lg blue" target="_blank" style="width: 300px">
        Impact Report Beta
    </a>
</div>