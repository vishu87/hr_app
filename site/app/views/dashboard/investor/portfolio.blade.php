<div class="row">
    <div class="col-md-9">

        <div style="height: 20px"></div>

        <div ng-if="portfolio_investments.length == 0 && loading" style="text-align:center; font-size: 20px; margin-top: 100px">
            <img src="{{url('assets/svg/Shopping-Cart.svg')}}">
            Your portfolio is empty. Build your portfolio?  Or <a href="{{url('investor/search')}}">search for investments</a>
        </div>

        <div class="row" ng-show="portfolio_investments.length > 0">
            <div class="col-md-6">
                <div class="">
                    <input type="checkbox" ng-model="include_cart"> Include cart investments
                </div>
            </div>
            <div class="col-md-6" style="text-align:right">
                Group By
                <select ng-change="portfolioGroup()" ng-model="grouper">
                    <option ng-value="sorter.value" ng-repeat="sorter in portfolio_sorters">@{{sorter.name}}</option>
                </select>
            </div>
        </div>

        <div class="recos" ng-show="portfolio_investments.length > 0">
            <div class="recommendation" ng-repeat="group in portfolio_groups" ng-if="group.show">
                <div class="andorra-title">
                    <div>
                        <div class="title">@{{group.name}}</div>
                    </div>
                </div>
                <div class="investments">
                    <table class="table portfolio-table">
                        <thead>
                            <tr>
                                <td style="width: 350px;">Investment</td>
                                <td style="width: 150px">Amount</td>
                                <td style="width: 80px" class="center">% of portfolio</td>
                                <td></td>
                                <td style="width: 70px;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="investment in portfolio_investments" ng-if="investment[portfolio_sorter_field] == group.id && (investment.invested == 1 || include_cart)">
                                @include('dashboard.investor.portfolio_item_list')
                            </tr>
                            <tr class="total">
                                <td>Total @{{group.name}}</td>
                                <td>@{{ include_cart ? group.total_p : group.total_i | currency}}</td>
                                <td class="center">
                                    <span ng-bind=" portfolio_amount != 0 ? (group.total_p/portfolio_amount*100).toFixed(2) : 'NA' " ng-if="include_cart"></span>
                                    <span ng-bind=" investment_amount != 0 ? (group.total_i/investment_amount*100).toFixed(2) : 'NA' " ng-if="!include_cart"></span>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="home-sidebar">
            <div class="portfolio-amount">
                <div class="table">
                    <div class="img"><img src="{{url('assets/svg/Coins-3.svg')}}"></div>
                    <div>Your Portfolio</div>
                </div>
                @{{ include_cart ? portfolio_amount :  investment_amount | currency}}
            </div>
            <hr>
            <a href="{{url('investor/compare-andorra')}}" class="btn green block">Impact Optimization</a>

            <a href="{{url('investor/andorra-recommended-portfolio')}}" class="btn green block" style="margin-top: 15px">Recommended Portfolio</a>

            <a href="{{url('investor/recommendations')}}" class="btn green block" style="margin-top: 15px">Top Matches</a>

            <hr>
        </div>
    </div>
</div>