<div class="table title-bar box-shadow">
	<div @if(Input::has("ref")) class="normal" @endif>
		@if(!Input::has("ref"))
		<div class="float-btn">
			<i class="fa fa-bars"></i>
		</div>
		@endif
	</div>
	<div class="user-info">
		<div class="table">
			@if(isset($icon))
			<div class="img">
				<img src="{{url($icon)}}" class="svg-icon">
			</div>
			@endif
			<div>
				<div class="name">{{(isset($title))?$title:''}}</div>
				<div>{{(isset($sub_title))?$sub_title:''}}</div>
			</div>
		</div>
	</div>
	<div style="width: 250px;">
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
	<div style="width: 150px;">
		<div style="font-size: 16px; cursor: pointer;" ng-click="showHideFilters()">
			<i class="fa fa-filter"></i> @{{(!show_filters)?'Show' :' Hide'}} Filters (@{{applied_filters_names.length}})
		</div>
	</div>
</div>