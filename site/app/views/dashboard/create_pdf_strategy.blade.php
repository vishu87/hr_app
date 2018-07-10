@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak product-page" ng-controller="StrategyPDFCtrl" ng-init="initials(); ">
	@include('dashboard.title_bar')
	<div class="container pdf-create" style="padding-top: 30px; padding-bottom: 50px;">

		<div class="pdf-section" ng-repeat="section in sections" ng-init="sectionIndex=$index">
			<h2 ng-bind="section.name"></h2>
			<div class="section-body">
				<div ng-repeat="item in section.items" ng-class="(item.type == 'trix' || item.type == 'trix-self') ? 'item form-group' : 'item-inline' " ng-if = " (item.type == 'trix' || item.type == 'trix-self') || (item.type == 'inline' && data[item.slug])">
					
					<div ng-if="item.type == 'trix' ">
			    		<label>@{{item.name}}</label>
			    		<trix-editor ng-model="texts[item.slug]" trix-id="@{{sectionIndex*100 + $index}}" angular-trix></trix-editor>
			    	</div>

					<div ng-if="item.type == 'inline'">
						<b>@{{item.name}}</b> - @{{data[item.slug]}}
					</div>

					<div ng-if="item.type == 'trix-self' ">
			    		<label>@{{item.name}}</label>
			    		<trix-editor ng-model="item.slug" angular-trix trix-id="@{{$index}}"></trix-editor>
			    	</div>

					<a href="#" class="delete-btn" ng-if="item.type == 'trix' || item.type == 'trix-self' ">Delete Section</a>

				</div>
				<div class="add-more" ng-if="section.more_tags">
					<div class="row">
						<div class="col-md-12">
							<label style="margin-bottom: 10px"><b>Add New Section</b></label>
						</div>
						<div class="col-md-3">
							<input type="text" ng-model="section.add_more_title" class="form-control" placeholder="Title">
						</div>
						<div class="col-md-12">
							<trix-editor ng-model="section.add_more_value" angular-trix></trix-editor>
						</div>
						<div class="col-md-2">
							<button class="btn blue add-section" ng-click="AddTag(section)">Add Section</button>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div style="margin: 50px 0" class="text-center">
			<a href="{{url('/assets/files/Impact_Investment_Policy.pdf')}}" target="_blank" class="btn green">
				SAVE ALL CHANGES &amp; GENERATE PDF
			</a>
		</div>

    </div>
    @include('copyright')
</main>
@include('footer')