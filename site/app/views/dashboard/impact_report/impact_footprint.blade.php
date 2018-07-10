<div class="product-impact" id="impact_footprint">
	<div class="heading-impact">Impact Footprint</div>

	<div  ng-repeat="graph in footprints" ng-if="footprints.length > 0" class="graph-sec">

		<div ng-if="graph.type == 'Doubledonut' ">
			@include('dashboard.impact_report.ddonut')
		</div>

		<div ng-if="graph.type == 'Sankey' ">
			@include('dashboard.impact_report.sankey')
		</div>

	</div>
</div>
