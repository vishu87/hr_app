<div class="product-overview" id="overview">
	<div class="table product-heading top">
		<div class="icon">
			<img src="{{url($image)}}">
		</div>
		<div>
			<div class="product-name">
    			{{$investment->product_name}}
    		</div>
    		<div class="company-name">{{$investment->company_name}}</div>
		</div>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-8">
				@if($investment->overview)
					<div class="text-justify">
						<b>Company Overview:</b> {{$investment->overview}}
					</div>
				@endif
				@if($investment->financial_product_description)
					<div class="text-justify">
						<b>Product Description:</b> {{$investment->financial_product_description}}
					</div>
				@endif

				<div style="margin: 15px 0">
					<div class="row">
						@if($investment->identifier)
							<div class="col-md-6">
								<b>Identifier:</b> {{$investment->identifier}}
							</div>
						@endif
						
						<div class="col-md-6" ng-if="investment.accredited_investor_name">
							<b>Limited to Accredited Investors:</b> @{{investment.accredited_investor_name}}
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-4 product-side" style="margin-bottom: 15px;">

				<ul>
					@if($investment->website)
						<li>
							<img src="{{url('assets/product_page_icons/icon-low-environmental-impact-300x300.jpeg')}}">
							<a href="{{$investment->website}}">{{$investment->website}}</a>
						</li>
					@endif
					@if($investment->address)
						<li>
							<img src="{{url('assets/product_page_icons/addressicon.png')}}">
							{{$investment->address}}
						</li>
					@endif

					@if($investment->contact_email)
						<li>
							<img src="{{url('assets/product_page_icons/emailicon.png')}}">
							{{$investment->contact_email}}
						</li>
					@endif

					@if($investment->contact_phone_number)
						<li>
							<img src="{{url('assets/product_page_icons/phoneicon.png')}}">
							{{$investment->contact_phone_number}}
						</li>
					@endif
				</ul>

				@if($investment->company_foundation_year)
					<div><b>Year Founded:</b> {{$investment->company_foundation_year}}</div>
				@endif

				@if($investment->actively_raising)
					<div>
						<b>Actively Raising:</b> {{$investment->actively_raising}}
					</div>
				@endif
			</div>
		</div>

		<div class="row product-section" ng-if="!loading">
			
			<div class="col-md-4" ng-if="investment.irr_score" ng-click="andorraIRR()">
				<div class="item green-back" >
					<div class="type">
						<img src="{{url('assets/product_page_icons/impact_section/irrScore_icon.png')}}">
					</div>
					<div class="text">
						<div class="head">Andorra IRR Score<sup>TM</sup></div>
						<div class="value" ng-bind="investment.irr_score"></div>
					</div>
					<div class="abs-exclamation">
						<i class = "fa fa-exclamation-circle"></i>
					</div>
				</div>
			</div>

			<div class="col-md-4" ng-if="investment.asset_class_name">
				<div class="item blue-back" >
					<div class="type">
						<img src="{{url('assets/product_page_icons/financial_section/asset_class_icon.png')}}">
					</div>
					<div class="text">
						<div class="head">Asset Class Name</div>
						<div class="value" ng-bind="investment.major_asset_class_name"></div>
					</div>
				</div>
			</div>

			<div class="col-md-4" ng-if="investment.impact_sectors.length > 0">
				<div class="item green-back">
					<div class="type">
						<img src="{{url('assets/product_page_icons/impact_section/impact_industries_icon.png')}}">
					</div>
					<div class="text">
						<div class="head">Impact Sectors</div>
						<div class="value" ng-repeat="item in investment.impact_sectors" ng-bind="item.value"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>