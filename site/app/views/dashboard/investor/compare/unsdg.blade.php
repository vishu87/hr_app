<div>
	<div class="head">
		<div>Your Portfolio</div>
		<div>UN SDG</div>
		<div>Andorra Strategy</div>
		<div>Rebalancing</div>
	</div>
</div>
<div ng-repeat = "unsdg in unsdgs" style="border-left: 3px solid @{{unsdg.color}}; margin: 10px 0">
	<div ng-click="unsdg.open = !unsdg.open" style="cursor: pointer;">
		<div class="number">
			<span>
 				@{{unsdg.user_allocation}}%
			</span>
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(unsdg.user_allocation, unsdg.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(unsdg.user_allocation, unsdg.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(unsdg.user_allocation, unsdg.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{unsdg.name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(unsdg.user_allocation, unsdg.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{unsdg.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(unsdg.user_allocation, unsdg.andorra_allocation,4, unsdg.name )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>
</div>