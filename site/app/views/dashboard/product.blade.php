@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak product-page" ng-controller="ProductPageCtrl" ng-init="investment_id = {{$investment->id}}; initials(); ">
	@include('dashboard.title_bar')
	<div class="container-fluid" style="padding-top: 50px;">
	    <div class="row">
	    	<div class="col-md-4">
	    		<div class="product-section">
	    			<div class="heading">
	    				Impact
	    			</div>
	    			@foreach($impact_types as $impact_type)
		    			@if($impact_type["type"] == 'single')
		    			<div class="item" ng-if="investment.{{$impact_type['slug']}} && investment.{{$impact_type['slug']}} != '' ">
		    				<div class="type">
		    					{{$impact_type["name"]}}
		    				</div>
		    				<div class="text">
		    					<div class="value" ng-bind="investment.{{$impact_type['slug']}}"></div>
		    				</div>
		    			</div>
		    			@endif

		    			@if($impact_type["type"] == 'multiple')
		    			<div class="item" ng-if="investment.{{$impact_type['slug']}}.length > 0">
		    				<div class="type">
		    					{{$impact_type["name"]}}
		    				</div>
		    				<div class="text">
		    					<div class="value" ng-repeat="item in investment.{{$impact_type['slug']}}" ng-bind="item.value"></div>
		    				</div>
		    			</div>
		    			@endif
	    			@endforeach
	    		</div>
	    	</div>
	    	<div class="col-md-4 product-section">
	    		<div class="product-name">
	    			{{$investment->product_name}}
	    		</div>
	    		<div class="company-name">{{$investment->company_name}}</div>

	    		<div class="row" ng-if="!loading">
	    			<div class="col-md-6" ng-if="investment.financial_instrument_name">
	    				<div class="desc">
	    					<span>Asset Class</span>
	    					@{{investment.financial_instrument_name}}
	    				</div>
	    			</div>
	    			<div class="col-md-6" ng-if="investment.asset_class_name">
	    				<div class="desc">
	    					<span>Sub Asset Class</span>
	    					@{{investment.asset_class_name}}
	    				</div>
	    			</div>
	    		</div>
	    		<div class="item item-big" ng-if="investment.impact_sectors.length > 0">
	    			<div class="logo">
	    				<img src="{{url('assets/svg/Factory.svg')}}">
	    			</div>
	    			<div class="text">
	    				<div class="head">Impact Sectors</div>
		    			<div class="value" ng-repeat="item in investment.impact_sectors" ng-bind="item.value"></div>
	    			</div>
	    		</div>
	    		<div class="item item-big" ng-if="investment.impact_goals.length > 0">
	    			<div class="logo">
	    				<img src="{{url('assets/img/wheel.png')}}">
	    			</div>
	    			<div class="text">
	    				<div class="head">UN SDG</div>
		    			<div class="value" ng-repeat="item in investment.impact_goals" ng-bind="item.value"></div>
	    			</div>
	    		</div>
	    		<div class="item item-big" ng-if="investment.impact_goals.length > 0">
	    			<div class="logo">
	    				<img src="{{url('assets/img/worldwide.svg')}}">
	    			</div>
	    			<div class="text">
	    				<div class="head">Impact Areas</div>
		    			<div class="value" ng-repeat="item in investment.impact_areas" ng-bind="item.value"></div>
	    			</div>
	    		</div>

	    		<div class="row" ng-if="!loading">
	    			<div class="col-md-12">
	    				<div class="policy-document small">
				 			<a href="{{url('assets/img/Impact_Tear_Sheet.PDF')}}" target="_blank">
				 				<i class="fa fa-file-pdf-o"></i> Impact Tear Sheet
				 			</a>
				 		</div>
	    			</div>
	    			<div class="col-md-12">
	    				<div class="policy-document small">
				 			<a href="{{url('assets/img/Multiple_Impact_Investment_Descriptions.PDF')}}" target="_blank">
				 				<i class="fa fa-file-pdf-o"></i> Impact Investment Description
				 			</a>
				 		</div>
	    			</div>
	    		</div>
	    		<div style="height: 50px"></div>
	    	</div>
	    	<div class="col-md-4">
	    		<div class="product-section">
	    			<div class="heading">
	    				Financial
	    			</div>
	    			@foreach($financial_types as $financial_type)
		    			@if($financial_type["type"] == 'single')
		    			<div class="item" ng-if="investment.{{$financial_type['slug']}} && investment.{{$financial_type['slug']}} != '' ">
		    				<div class="type">
		    					{{$financial_type["name"]}}
		    				</div>
		    				<div class="text">
		    					<div class="value" ng-bind="investment.{{$financial_type['slug']}}"></div>
		    				</div>
		    			</div>
		    			@endif

		    			@if($financial_type["type"] == 'multiple')
		    			<div class="item" ng-if="investment.{{$financial_type['slug']}}.length > 0">
		    				<div class="type">
		    					{{$financial_type["name"]}}
		    				</div>
		    				<div class="text">
		    					<div class="value" ng-repeat="item in investment.{{$financial_type['slug']}}" ng-bind="item.value"></div>
		    				</div>
		    			</div>
		    			@endif

		    			@if($financial_type["type"] == 'links')
		    			<div class="item" ng-if="investment.{{$financial_type['slug']}}.length > 0">
		    				<div class="type">
		    					{{$financial_type["name"]}}
		    				</div>
		    				<div class="text">
		    					<div class="value" ng-repeat="item in investment.{{$financial_type['slug']}}">
		    						<a href="{{url('/')}}/@{{item.link}}" target="_blank">@{{item.value}}</a>
		    					</div>
		    				</div>
		    			</div>
		    			@endif
	    			@endforeach
	    		</div>
	    	</div>
	    </div>
    </div>
    @include('dashboard.investor.amount_modal')
</main>

@include('footer')