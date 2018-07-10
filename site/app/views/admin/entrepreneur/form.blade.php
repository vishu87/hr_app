<div ng-controller="entrepreneurCtrl" ng-init="entrepreneur_id={{(isset($entrepreneur_id))?$entrepreneur_id:0}}; tab_id=1; initials()" class="ng-cloak entrepreneur-form">
	<ul class="nav nav-tabs">
		<li class="@{{(tab_id==1)?'active':''}}"><a href="javascript:;" ng-click="tab_id=1">Basic Information</a></li>
		<li class="@{{(tab_id==2)?'active':''}}"><a href="javascript:;" ng-click="tab_id=2">Management Team</a></li>
		<li class="@{{(tab_id==5)?'active':''}}"><a href="javascript:;" ng-click="tab_id=5">Investor Materials</a></li>
		@if(Auth::user()->privilege == 1)
		<li class="@{{(tab_id==6)?'active':''}}"><a href="javascript:;" ng-click="tab_id=6">Andorra</a></li>
		@endif
	</ul>
	<div style="min-height: 320px;">
		<form name="entrepreneurForm" ng-submit="onSubmit(entrepreneurForm.$valid)">
			<div ng-show="tab_id == 1">
				@include('admin.entrepreneur.basic_info')
				@include('admin.entrepreneur.headquarters')
			</div>
			<div ng-show="tab_id == 2">
				@include('admin.entrepreneur.management_team')
			</div>
			
			<div ng-show="tab_id == 5">
				@include('admin.entrepreneur.investor_material')
			</div>
			<div ng-show="tab_id == 6">
				@include('admin.entrepreneur.andorra')
			</div>
		</form>
	</div>
	<hr>
	<div style="margin-bottom: 50px">
		<button type="button" class="btn" ng-click="tab_id=5"><i class="fa fa-angle-double-left"></i> Previous</button>
		<button type="submit" class="btn green pull-right" ladda="processing" ng-click="onSubmit()">Save</button>
	</div>
</div>