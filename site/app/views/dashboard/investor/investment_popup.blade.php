<div class="investment-details" ng-show="show_investement">
    <a href="javascript:;" class="close-btn" ng-click="show_investement = false">Close</a>
    <h4>
        <a href="{{url('/')}}/product/@{{open_investment.id}}" target="_blank">@{{open_investment.product_name}}</a>
    </h4>
    <div class="company">@{{open_investment.company_name}}</div>
    <div ng-show="!processing">
        <div class="stats">
            <table class="table">
                <tr>
                    <td>Asset Class</td>
                    <td>@{{open_investment.asset_class_name}}</td>
                </tr>
                <tr ng-if="open_investment.financial_instrument_name">
                    <td>Financial Instrument</td>
                    <td>@{{open_investment.financial_instrument_name}}</td>
                </tr>
                <tr ng-if="open_investment.target_irr">
                    <td>Projected Financial Return</td>
                    <td>@{{open_investment.target_irr}}%</td>
                </tr>
                <tr ng-if="open_investment.financial_return_expect_name">
                    <td>Financial Return Expectation</td>
                    <td>@{{open_investment.financial_return_expect_name}}</td>
                </tr>
                <tr ng-if="open_investment.time_horizon_year">
                    <td>Time Horizon</td>
                    <td>@{{open_investment.time_horizon_year}} Years</td>
                </tr>

                <tr ng-if="open_investment.impact_areas.length > 0">
                    <td>Top Impact Areas</td>
                    <td>
                        <span ng-repeat="area in open_investment.impact_areas track by $index">@{{ $index!=0 ?', ':''}}@{{area}}</span>
                    </td>
                </tr>
                <tr ng-if="open_investment.impact_sectors.length > 0">
                    <td>Top Impact Sectors</td>
                    <td>
                        <span ng-repeat="sector in open_investment.impact_sectors track by $index">@{{ $index!=0 ?', ':''}}@{{sector}}</span>
                    </td>
                </tr>
                <tr ng-if="open_investment.impact_industries.length > 0">
                    <td>Top Impact Industries</td>
                    <td>
                        <span ng-repeat="industry in open_investment.impact_industries track by $index">@{{ $index!=0 ?', ':''}}@{{industry}}</span>
                    </td>
                </tr>
            </table>
        </div>
        <button ladda="adding" class="btn btn-block blue" ng-click="addPortfolioStart(open_investment)" ng-if="!open_investment.in_portfolio">Add to Portfolio</button>

        <button ladda="adding" class="btn btn-block red" ng-click="addPortfolio(open_investment)" ng-if="open_investment.in_portfolio">Remove from Portfolio</button>

    </div>
</div>