<div ng-controller="investmentCtrl" ng-init="investment_id={{(isset($investment_id))?$investment_id:0}}; tab_id=1; entrepreneur_id={{$entrepreneur_id}}; initials();" class="ng-cloak entrepreneur-form">
	<div>
		<div class="row ng-cloak">
			<div class="col-md-8">
				<h1 class="page-title">
					@{{investment_id != 0 ? 'Update':'Add'}} Investment - {{$entrepreneur->company_name}}
				</h1>
			</div>
			<div class="col-md-4">
				<a class="btn default pull-right" href="{{url('/entrepreneur/investments/'.$entrepreneur_id)}}">Go Back</a>
			</div>
		</div>
		
	</div>
	<ul class="nav nav-tabs">
		<li class="@{{(tab_id==1)?'active':''}}"><a href="javascript:;" ng-click="tab_id=1">Financials</a></li>
		<li class="@{{(tab_id==2)?'active':''}}"><a href="javascript:;" ng-click="tab_id=2">Impact</a></li>
		<li class="@{{(tab_id==3)?'active':''}}"><a href="javascript:;" ng-click="tab_id=3">Investor Material</a></li>
		<li class="@{{(tab_id==4)?'active':''}}"><a href="javascript:;" ng-click="tab_id=4">Andorra</a></li>
		
	</ul>
	<div style="min-height: 320px;">
		<form name="entrepreneurForm" ng-submit="onSubmit(entrepreneurForm.$valid)">
			
			<div ng-show="tab_id == 1">
				@include('admin.entrepreneur.investments.financials')
			</div>
			
			<div ng-show="tab_id == 2">
				@include('admin.entrepreneur.investments.impact')
			</div>
			
			<div ng-show="tab_id == 3">
				@include('admin.entrepreneur.investments.investor_material')
			</div>

			<div ng-show="tab_id == 4">
				@include('admin.entrepreneur.investments.andorra')
			</div>
		</form>
	</div>
	<hr>
	<div style="margin-bottom: 50px">
		<button type="button" class="btn" ng-click="tab_id=tab_id-1"><i class="fa fa-angle-double-left"></i> Previous</button>
		<button type="submit" class="btn green pull-right" ladda="processing" ng-click="onSubmit()">Save</button>
	</div>
</div>