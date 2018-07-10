<div class="row">
    <div class="col-md-2" style="padding-right: 0; padding-bottom: 50px; ">
        <div class="side-menu-item">
            <div ng-class="top_matches ? 'active':'' " ng-click="filterMap(null)">Top 10 Matches</div>
        </div>

        <div ng-repeat="filter_class in reco_filters">
            <div class="side-menu-item" ng-repeat="filter in filter_class.groups" ng-if="filter.investments.length > 0" >
                <div ng-click="filterMap(filter)" ng-class="active_class == filter.match_field && active_value == filter.value && !top_matches ? 'active':''"> Top Matches in @{{filter.name}}</div>
            </div>
        </div>
    </div>
    <div class="col-md-10" style="padding-right: 0">
        <div style="position: relative;">
            @include('dashboard.investor.investment_popup')
            <div id="map" style="width:100%; height: 500px; overflow:hidden"></div>
        </div>
    </div>
</div>