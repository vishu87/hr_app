<div>
    <!--filter selection-->
    <div class="container-fluid" id="search_filters" style="margin-top: 20px; display: none">
        <div class="table">
            <span style="font-size: 18px; padding-right: 10px;">Filters</span>
            <span ng-if="applied_filters_names.length == 0" style="font-size: 12px; color: #888">No filters applied</span>
            <span ng-repeat="applied_filter in applied_filters_names" ng-click="addFilter(applied_filter.type, applied_filter.id, applied_filter.name )" class="applied-filter">
                    @{{applied_filter.type == 'accredited_investor' ? 'Accredited Investor - ' : ''}}
                    @{{applied_filter.type == 'raising_capital' ? 'Actively Raising - ' : ''}}
                    @{{applied_filter.name}} <i class="fa fa-remove"></i>
            </span>
        </div>
        <div ng-repeat="filter_type in filter_types" class="search-filters">
            <!-- <h4 style="margin-top: 0; margin-bottom: 20px;"></h4> -->
            <div class="search-filter table">
                <div>@{{filter_type.name}}</div>
                <div>
                    <div class="filter" ng-repeat="filter in filter_type.filters" style="margin-bottom:10px">
                        <div id="filter_@{{filter.type}}" tabindex="-1" class="input-filter">
                            <input type="text" ng-focus="filter.showdrop = true" class="form-control" ng-model="filter.search" placeholder=" @{{filter.name}}" ng-blur="addFilter(0,0,0, filter)">
                            <ul ng-show="filter.showdrop">
                                <li ng-repeat="value in filter.values | filter : {name : filter.search}" ng-mousedown="addFilter(filter.type, value.id, value.name, filter)">
                                    @{{value.name}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--filter selection end -->
    <div style="position: relative;">
        @include('dashboard.investor.investment_popup')
        <div id="map" style="width:100%; height: 500px; overflow:hidden"></div>
    </div>
</div>

@include('dashboard.investor.amount_modal')