<div>
	<div class="head">
		<div>Your Portfolio</div>
		<div>Geogrphical Area</div>
		<div>Andorra Strategy</div>
		<div>Rebalancing</div>
	</div>
</div>
<div ng-repeat = "location in locations" style="border-left: 3px solid @{{location.color}}; margin: 10px 0">
	<div ng-click="location.open = !location.open" style="cursor: pointer;">
		<div class="number">
			<span>
				<i class="fa fa-angle-right" ng-show="!location.open" ng-if="location.industry_allocations.length > 0"></i>
 				<i class="fa fa-angle-down" ng-show="location.open" ng-if="location.industry_allocations.length > 0"></i>
 				@{{location.user_allocation}}%
			</span>
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(location.user_allocation, location.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(location.user_allocation, location.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(location.user_allocation, location.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{location.name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(location.user_allocation, location.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{location.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(location.user_allocation, location.andorra_allocation,4, location.name )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>

	<div ng-repeat="sub_location in location.division" ng-show="location.openx" >
		<div class="number">
 			@{{sub_location.user_allocation}}%
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(sub_location.user_allocation, sub_location.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(sub_location.user_allocation, sub_location.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(sub_location.user_allocation, sub_location.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{sub_location.geo_name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(sub_location.user_allocation, sub_location.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{sub_location.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(sub_location.user_allocation, sub_location.andorra_allocation,4,sub_location.geo_name  )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>
</div>