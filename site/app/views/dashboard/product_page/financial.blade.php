<div class="product-financial product-section" id="financial">
	<div class="heading">Financial Information</div>

	<div style="margin-bottom: 30px">
		@if($investment->financial_product_description)
			<div>
				<b>Financial Description:</b> {{$investment->financial_product_description}}
			</div>
		@endif
	</div>

	<div class="row">
		@foreach($financial_types as $financial_type)
			@if($financial_type["type"] == 'single')
			<div class="col-md-4" ng-if="investment.{{$financial_type['slug']}} && investment.{{$financial_type['slug']}} != '' ">
				<div class="item blue-back" >
					<div class="type">
						<img src="{{url('assets/product_page_icons/'.$financial_type['icon'])}}">
					</div>
					<div class="text">
						<div class="head">{{$financial_type["name"]}}</div>
						<div class="value" ng-bind="investment.{{$financial_type['slug']}}"></div>
					</div>
				</div>
			</div>
			@endif

			@if($financial_type["type"] == 'multiple')
			<div class="col-md-4"  ng-if="investment.{{$financial_type['slug']}}.length > 0">
				<div class="item blue-back">
					<div class="type">
						{{$financial_type["name"]}}
					</div>
					<div class="text">
						<div class="value" ng-repeat="item in investment.{{$financial_type['slug']}}" ng-bind="item.value"></div>
					</div>
				</div>
			</div>
			@endif

			@if($financial_type["type"] == 'links')
			<div class="col-md-4"  ng-if="investment.{{$financial_type['slug']}}.length > 0">
				<div class="item blue-back">
					<div class="type">
						{{$financial_type["name"]}}
					</div>
					<div class="text">
						<div class="value" ng-repeat="item in investment.{{$financial_type['slug']}}">
							<a href="{{url('/')}}/@{{item.link}}" target="_blank">@{{item.value}}</a>
						</div>
					</div>
				</div>
			</div>
			@endif
		@endforeach
	</div>
</div>