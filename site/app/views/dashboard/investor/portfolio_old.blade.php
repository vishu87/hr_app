<div class="row">
    <div class="col-md-9">
        <div class="row">
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
        <div class="recos">
            <div class="recommendation" ng-repeat="group in portfolio_groups" ng-if="group.show">
                <div class="title">
                    @{{group.name}}
                </div>
                <div class="investments">
                    <div class="investment" ng-repeat="investment in portfolio_investments" ng-if="investment[portfolio_sorter_field] == group.id && (investment.invested || include_cart)">
                        @include('dashboard.investor.portfolio_item')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="match-portfolio">
            <h2>80%</h2>
            <span>Match to<br> ANDORRA Strategy</span>
        </div>

        <div class="compare">
            <a href="{{url('investor/compare-andorra')}}">Compare with Strategy <i class="fa fa-angle-double-right"></i></a>
        </div>
    </div>
</div>