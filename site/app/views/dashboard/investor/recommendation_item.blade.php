<div ng-click="investmentDetails(investment.id, investment.product_name);">
    <div class="company" ng-bind="investment.company_name"></div>
    <div class="image" style="background: @{{investment.color}}">
        <img ng-src="@{{investment.icon}}">
    </div>
    <a href="{{url('/')}}/product/@{{investment.id}}" target="_blank" class="product-link">
        <h2 ng-bind="investment.product_name"></h2>
    </a>
    <div style="text-align:center" ng-if="investment.score">Score <span ng-bind="investment.score"></span></div>
    <div class="stats">
        <div class="row">
            <div class="col-md-7">Major Asset Class</div>
            <div class="col-md-5"><span>@{{investment.major_asset_class_name}}</span></div>
        </div>
        <div class="row">
            <div class="col-md-7">Time Horizon</div>
            <div class="col-md-5"><span>@{{investment.time_horizon_year}} Years</span></div>
        </div>
        <div class="row">
            <div class="col-md-7">Expected Financial Return</div>
            <div class="col-md-5"><span>@{{investment.target_irr}} %</span></div>
        </div>
    </div>
    <button ladda="adding" class="btn btn-block hidden" ng-class="open_investment.in_portfolio ? 'red' : 'blue' " ng-click="addPortfolioStart(open_investment)">@{{open_investment.in_portfolio ? 'Remove from' : 'Add to' }} Portfolio</button>
</div>