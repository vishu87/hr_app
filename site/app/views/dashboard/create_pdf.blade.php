@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak product-page" ng-controller="ProductPagePDFCtrl" ng-init="investment_id = {{$investment->id}}; initials(); ">
	@include('dashboard.title_bar')
	<div class="container pdf-create" style="padding-top: 30px; padding-bottom: 50px;">

		<div class="pdf-section">
			<h2>General Information</h2>
		    <div class="section-body">
		    	<div class="item form-group">
			    	<div>
			    		<label>Company Description</label>
			    		<trix-editor ng-model="investment.overview" angular-trix></trix-editor>
			    	</div>
			    	<a href="#" class="delete-btn">Delete Section</a>
			    </div>

			    <div class="item form-group">
			    	<div>
			    		<label>Product Description</label>
			    		<trix-editor ng-model="investment.impact_product_description" angular-trix></trix-editor>
			    	</div>
			    	<a href="#" class="delete-btn">Delete Section</a>
			    </div>

			    @if($entrepreneur->address)
		    		<div class="item-inline">
		    			<div><b>Headquarter</b> - 708 Church St Suite 227, Evanston, IL 60201, USA</div>
		    			<a href="#" class="delete-btn">Delete Tag</a>
		    		</div>
		    	@endif

		    	<div class="item-inline" ng-if="investment.website">
		    		<div><b>Website</b> - @{{investment.website}}</div>
		    		<a href="#" class="delete-btn">Delete Tag</a>
		    	</div>
		    </div>
		</div>

		<div class="pdf-section" ng-repeat="section in sections">
			<h2 ng-bind="section.name"></h2>
			<div class="section-body">
				<div ng-repeat="item in section.items" ng-class="item.type == 'trix' ? 'item form-group' : 'item-inline' " ng-if = " (item.type == 'trix' || item.type == 'inline-self') || (item.type == 'inline' && investment[item.slug]) ||  (item.type == 'multiple' && investment[item.slug].length > 0) ">
					
					<div ng-if="item.type == 'trix' ">
			    		<label>@{{item.name}}</label>
			    		<trix-editor ng-model="investment.overview" angular-trix></trix-editor>
			    	</div>

					<div ng-if="item.type == 'inline'">
						<b>@{{item.name}}</b> - @{{investment[item.slug]}}
					</div>

					<div ng-if="item.type == 'inline-self'">
						<b>@{{item.name}}</b> - @{{item.slug}}
					</div>

					<div ng-if="item.type == 'multiple'">
						<b>@{{item.name}}</b> - <span ng-repeat="ite in investment[item.slug]">@{{ite.value}}</span>
					</div>
					<a href="#" class="delete-btn">Delete @{{item.type == 'trix' ? 'Section' : 'Tag' }}</a>

				</div>
				<div class="add-more" ng-if="section.more_tags">
					<div class="row">
						<div class="col-md-2">
							<label>Add More Tags</label>
						</div>
						<div class="col-md-4">
							<input type="text" ng-model="section.add_more_title" class="form-control" placeholder="Title">
						</div>
						<div class="col-md-4">
							<input type="text" ng-model="section.add_more_value" class="form-control" placeholder="Value">
						</div>
						<div class="col-md-2">
							<button class="btn blue" ng-click="AddTag(section)">Add Tag</button>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div style="margin: 50px 0" class="text-center">
			<a href="{{url('/assets/files/Product_PDF.pdf')}}" target="_blank" class="btn green">
				SAVE ALL CHANGES &amp; GENERATE PDF
			</a>
		</div>

    </div>
    @include('copyright')
</main>
@include('footer')