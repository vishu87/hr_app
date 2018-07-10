<div>
	<div class="head">
		<div>Your Portfolio</div>
		<div>Sector</div>
		<div>Andorra Strategy</div>
		<div>Rebalancing</div>
	</div>
</div>
<div ng-repeat = "sector in sectors" style="border-left: 3px solid @{{sector.color}}; margin: 10px 0">
	<div ng-click="sector.open = !sector.open" style="cursor: pointer;">
		<div class="number">
			<span>
				<i class="fa fa-angle-right" ng-show="!sector.open" ng-if="sector.industry_allocations.length > 0"></i>
 				<i class="fa fa-angle-down" ng-show="sector.open" ng-if="sector.industry_allocations.length > 0"></i>
 				@{{sector.user_allocation}}%
			</span>
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(sector.user_allocation, sector.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(sector.user_allocation, sector.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(sector.user_allocation, sector.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{sector.sector_name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(sector.user_allocation, sector.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{sector.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(sector.user_allocation, sector.andorra_allocation,4, sector.sector_name )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>

	<div ng-repeat="industry in sector.industry_allocations" ng-show="sector.open">
		<div class="number">
 			@{{industry.user_allocation}}%
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(industry.user_allocation, industry.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(industry.user_allocation, industry.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(industry.user_allocation, industry.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{industry.industry_name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(industry.user_allocation, industry.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{industry.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(industry.user_allocation, industry.andorra_allocation,4,industry.industry_name  )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>
</div>