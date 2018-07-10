<div>
    <!--filter selection-->
    <div style="position: absolute; z-index: 999; width: 300px;">
        <div ng-repeat="filter_type in filter_types">
            <h4 style="margin-top: 0; margin-bottom: 20px;">@{{filter_type.name}}</h4>
            <div ng-repeat="filter in filter_type.filters" style="margin-bottom:10px">
                <div class="hidden">@{{filter.name}}</div>
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
    <!--filter selection end -->
    <div style="position: relative;">
        <div class="investment-details" ng-show="show_investement">
            <a href="javascript:;" class="close-btn" ng-click="show_investement = false">Close</a>
            <h4>@{{open_investment.product_name}}</h4>
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
                <button ladda="adding" class="btn btn-block" ng-class="open_investment.in_portfolio ? 'red' : 'blue' " ng-click="addPortfolioStart(open_investment)">@{{open_investment.in_portfolio ? 'Remove from' : 'Add to' }} Portfolio</button>
            </div>
        </div>
        <div id="map" style="width:100%; height: 500px; overflow:hidden"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
    	<div ng-repeat="filter_type in filter_types">
    		<h4 style="margin-top: 0; margin-bottom: 20px;">@{{filter_type.name}}</h4>
    		<div ng-repeat="filter in filter_type.filters" style="margin-bottom:10px">
	    		<div class="hidden">@{{filter.name}}</div>
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
    <div class="col-md-9">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-9">
                <span style="font-size: 18px; padding-right: 10px;">Filters</span>
                <span ng-if="applied_filters_names.length == 0" style="font-size: 12px; color: #888">No filters applied</span>
                <span ng-repeat="applied_filter in applied_filters_names" ng-click="addFilter(applied_filter.type, applied_filter.id, applied_filter.name )" class="applied-filter">
                    @{{applied_filter.name}} <i class="fa fa-remove"></i>
                </span>
            </div>
            <div class="col-md-3">
                <div class="my-portfolio">
                    <div ng-click="show_portfolio = !show_portfolio">My portfolio (@{{portfolios.length}}) <i class="fa" ng-class="show_portfolio ? 'fa-angle-up' : 'fa-angle-down' "></i></div>
                    <ul ng-show="show_portfolio">
                        <li ng-repeat="portfolio in portfolios">
                            <div class="single-portfolio">
                                <div class="table">
                                    <div>@{{portfolio.product_name}}</div>
                                    <div><button class="btn btn-xs" ng-click="addPortfolio(portfolio)"><i class="fa fa-remove"></i></button></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="amountModal" class="modal fade in modal-overflow" data-width="600" style="top:150px">
    <div class="modal-body">
        <h2 style="font-size: 24px">How much money do you want to invest?</h2>
        <input name="amount" ng-model="investment_amount" id="investment_amount" type="text" class="form-control" placeholder="Enter Amount">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button ladda="adding" type="button" class="btn blue block" style="margin-top:10px;" ng-click="addPortfolio(open_investment)">Add Investment</button>
            </div>
            <div class="col-md-6 hidden">
                <button type="button" class="btn green block" style="margin-top:10px;">Invest</button>
            </div>
        </div>
    </div>
</div>