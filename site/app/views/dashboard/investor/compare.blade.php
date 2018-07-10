<style type="text/css">
	.andorra-bar {
		margin-top: -30px;
		text-align: center;
	}
</style>

<div style="margin-top: 20px; position: relative;">
	<div class="row" style="margin-bottom: 20px;">
        <div class="col-md-6">
            <div class="">
                <input type="checkbox" ng-model="include_cart"> Include cart investments
            </div>
        </div>
        <div class="col-md-6" style="text-align:right">
            Group By
            <select ng-model="grouper">
                <option ng-value="1">Asset Class</option>
                <option ng-value="2">Impact Sector</option>
                <option ng-value="3">Geography</option>
                <option ng-value="4">UN SDG</option>
                <option ng-value="5">Liquidity Preference</option>
            </select>
        </div>
    </div>
	<div>
		<div class="table-compare" ng-if="grouper == 1">
			@include('dashboard.investor.compare.asset')
		</div>
		<div class="table-compare" ng-if="grouper == 2">
			@include('dashboard.investor.compare.sector')
		</div>
		<div class="table-compare" ng-if="grouper == 3">
			@include('dashboard.investor.compare.geography')
		</div>

		<div class="table-compare" ng-if="grouper == 4">
			@include('dashboard.investor.compare.unsdg')
		</div>

		<div class="table-compare" ng-if="grouper == 5">
			@include('dashboard.investor.compare.liquidity')
		</div>

	</div>

</div>