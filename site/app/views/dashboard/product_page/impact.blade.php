<div class="product-impact product-section" id="impact">
	<div class="heading">Impact Information</div>

	<div style="margin-bottom: 30px">
		@if($investment->impact_product_description)
			<div>
				<b>Financial Description:</b> {{$investment->impact_product_description}}
			</div>
		@endif
	</div>

	<div class="row">
		@foreach($impact_types as $impact_type)
			@if($impact_type["type"] == 'single')
			<div class="col-md-4" ng-if="investment.{{$impact_type['slug']}} && investment.{{$impact_type['slug']}} != '' ">
				<div class="item green-back">
					<div class="type">
						<img src="{{url('assets/product_page_icons/'.$impact_type['icon'])}}">
					</div>
					<div class="text">
						<div class="head">{{$impact_type["name"]}}</div>
						<div class="value" ng-bind="investment.{{$impact_type['slug']}}"></div>
					</div>
				</div>
			</div>
			@endif

			@if($impact_type["type"] == 'multiple')
			<div class="col-md-4" ng-if="investment.{{$impact_type['slug']}}.length > 0">
				<div class="item green-back">
					<div class="type">
						<img src="{{url('assets/product_page_icons/'.$impact_type['icon'])}}">
					</div>
					<div class="text">
						<div class="head">{{$impact_type["name"]}}</div>
						<div class="value" ng-repeat="item in investment.{{$impact_type['slug']}}" ng-bind="item.value"></div>
					</div>
				</div>
			</div>
			@endif
		@endforeach
	</div>
</div>