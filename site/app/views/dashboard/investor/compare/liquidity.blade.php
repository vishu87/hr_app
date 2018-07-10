<div>
	<div class="head">
		<div>Your Portfolio</div>
		<div>Liquidity</div>
		<div>Andorra Strategy</div>
		<div>Rebalancing</div>
	</div>
</div>
<div ng-repeat = "liquidity in liquidities" style="border-left: 3px solid @{{liquidity.color}}; margin: 10px 0">
	<div ng-click="liquidity.open = !liquidity.open" style="cursor: pointer;">
		<div class="number">
			<span>
 				@{{liquidity.user_allocation}}%
			</span>
		</div>
		<div class="status">
			<div class="table">
				<div class="buy" ng-class="compareNameColor(liquidity.user_allocation, liquidity.andorra_allocation,2) == 1 ? 'active' :'' ">BUY</div>
				<div class="hold" ng-class="compareNameColor(liquidity.user_allocation, liquidity.andorra_allocation,2) == 2 ? 'active' :'' ">HOLD</div>
				<div class="sell" ng-class="compareNameColor(liquidity.user_allocation, liquidity.andorra_allocation,2) == 3 ? 'active' :'' ">SELL</div>
			</div>
			<div style="position: relative;">
				<div class="name">
					<b>@{{liquidity.display_name}}</b>
				</div>
				<div class="bar">
					<div class="fill" style="width:@{{compareNameColor(liquidity.user_allocation, liquidity.andorra_allocation,3 )}}%; "></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
		<div class="number">
			@{{liquidity.andorra_allocation}}%
		</div>
		<div>
			<button class="btn" class="ttip" tooltips tooltip-template="@{{compareNameColor(liquidity.user_allocation, liquidity.andorra_allocation,4, liquidity.display_name )}}" tooltip-side="top">Rebalancing</button>
		</div>
	</div>
</div>