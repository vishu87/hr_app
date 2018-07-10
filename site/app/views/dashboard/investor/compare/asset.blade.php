<div>
	<div class="head">
		<div>Your Portfolio</div>
		<div>Asset Class Category</div>
		<div>Andorra Strategy</div>
		<div>Rebalancing</div>
	</div>
</div>
<div ng-repeat = "asset_class in classes" style="border-left: 3px solid @{{asset_class.color}}; margin: 10px 0">
	<div ng-click="asset_class.open = !asset_class.open" style="cursor: pointer;">
		<div class="number">
			<span>
				<i class="fa fa-angle-right" ng-show="!asset_class.open" ng-if="asset_class.sub_asset_allocation.length > 0 && asset_class.expandable == 1"></i>
 				<i class="fa fa-angle-down" ng-show="asset_class.open" ng-if="asset_class.sub_asset_allocation.length > 0 && asset_class.expandable == 1"></i>
 				@{{asset_class.user_allocation}}%
			</span>
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(asset_class.user_allocation, asset_class.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(asset_class.user_allocation, asset_class.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(asset_class.user_allocation, asset_class.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{asset_class.asset_name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(asset_class.user_allocation, asset_class.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{asset_class.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(asset_class.user_allocation, asset_class.andorra_allocation,4, asset_class.asset_name )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>

	<div ng-repeat="sub_asset in asset_class.sub_asset_allocation" ng-show="asset_class.open">
		<div class="number">
 			@{{sub_asset.user_allocation}}%
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(sub_asset.user_allocation, sub_asset.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(sub_asset.user_allocation, sub_asset.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(sub_asset.user_allocation, sub_asset.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{sub_asset.sub_asset_name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(sub_asset.user_allocation, sub_asset.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{sub_asset.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(sub_asset.user_allocation, sub_asset.andorra_allocation,4,sub_asset.sub_asset_name  )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>
</div>