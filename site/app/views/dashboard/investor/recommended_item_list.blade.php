<td>
	<a href="{{url('/')}}/product/@{{investment.id}}" target="_blank" class="product-link">@{{investment.product_name}}</a>
</td>

<td >
    <span>@{{(portfolio_amount*investment.allocation/100).toFixed(2) | currency}}</span>
</td>

<td class="center">@{{investment.allocation}} %</td>

<td class="center">
	<button ladda="investment.adding" class="btn btn-block btn-sm" ng-class="investment.in_portfolio ? 'red' : 'blue' " ng-click="addPortfolioStart(investment)">@{{investment.in_portfolio ? 'Remove from' : 'Add to' }} Portfolio</button>
</td>