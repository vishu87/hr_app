<div style="position: fixed; width:100%; right:50px; z-index: 999">
    @include('dashboard.investor.investment_popup')
</div>

<div >
    <div class="recos">
        <div class="recommendation">
            <div class="andorra-title">
                <div>
                    <div class="title">Top 10 Matches</div>
                </div>
            </div>
            <div class="investments">
                <div class="investment" ng-repeat="investment in reco_investments" ng-if="$index < 10">
                    @include('dashboard.investor.recommendation_item')
                </div>
            </div>
        </div>
    </div>

    <div class="recos" >
        <div class="recommendation group" ng-repeat="filter_class in reco_filters">
            <div ng-click="filter_class.open = !filter_class.open" class="group-title">
                <div class="row">
                    <div class="col-md-10"><div class="head">Top Matches by @{{filter_class.name}}</div></div>
                    <div class="col-md-2" style="text-align:right;">
                        <i class="fa fa-plus-circle" ng-if="!filter_class.open"></i>
                        <i class="fa fa-minus-circle" ng-if="filter_class.open"></i>
                    </div>
                </div>
            </div>

            <div class="recommendation" ng-repeat="filter in filter_class.groups" ng-if="filter_class.open && filter.investments.length > 0">
                <div class="row">
                    <div class="andorra-title col-md-12">
                        <div>
                            <div class="title">Top Matches in @{{filter.name}}</div>
                            <div style="text-align:right; display:inline-block" ng-if="filter.investments.length == 0">
                                No investment found in this category
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="investments" ng-if="filter.investments.length > 0">
                    <div class="investment" ng-repeat="investment in filter.investments">
                        @include('dashboard.investor.recommendation_item')
                    </div>
                </div>
            </div>

            <div ng-if="filter_class.not_found.length > 0 && filter_class.open" style="margin: 20px 10px">
                <b>No investments found in the following @{{filter_class.not_found_name}}:</b><br>
                <span ng-repeat="not_found in filter_class.not_found">
                    @{{$index != 0 ?', ':''}}@{{not_found.name}}
                </span>
            </div>

        </div>
    </div>
</div>

@include('dashboard.investor.amount_modal')