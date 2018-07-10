<td>
	<a href="{{url('/')}}/product/@{{investment.id}}" target="_blank" class="product-link">@{{investment.product_name}}</a>
</td>
<td>@{{investment.amount | currency}}</td>
<td class="center">
    <span ng-bind=" portfolio_amount != 0 ? (investment.amount/portfolio_amount*100).toFixed(2) : 'NA' " ng-if="include_cart"></span>
    <span ng-bind=" investment_amount != 0 ? (investment.amount/investment_amount*100).toFixed(2) : 'NA' " ng-if="!include_cart"></span>
</td>
<td style="text-align: right;">
	<button type="button" ladda="investment.processing" class="btn red" ng-click="sell(investment)" ng-if="investment.invested == 1" style="min-width: 100px">
		Sell
	</button>
	<button type="button" ladda="investment.processing" class="btn green" ng-click="invest(investment)" ng-if="investment.invested != 1" style="min-width: 100px">
		Invest
	</button>
</td>
<td>
	<button type="button" ladda="investment.processing" class="btn remove-btn" ng-click="remove(investment)" ng-if="investment.invested != 1">
		<i class="fa fa-remove"></i>
	</button>
</td>