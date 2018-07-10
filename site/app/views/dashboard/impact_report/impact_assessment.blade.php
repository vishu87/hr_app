<div class="product-impact " id="impact">
	<div class="heading-impact">Impact Assessment</div>

	<div  ng-repeat="graph in graphs" ng-if="graphs.length > 0" class="graph-sec">

		<div ng-if="graph.type == 'Doubledonut' ">
			@include('dashboard.impact_report.ddonut')
		</div>

		<div ng-if="graph.type == 'Sankey' ">
			@include('dashboard.impact_report.sankey')
		</div>

	</div>
</div>

<div class="graph-sec">
	<div class="row">

	    <div class="col-md-12" style="position:relative">
	        <div class="row">
	            <div class="col-md-8">
	                <h2>Geographic Allocation
	                    <span class="plus-icon" ng-click="map.show_how = !map.show_how">
	                        <i class="fa fa-info-circle"></i>
	                    </span>
	                </h2>
	            </div>
	            <div class="col-md-4 text-right">
	                <div class="switch-box">
	                    <div class="table">
	                        <div ng-class="!map.show_amount ? 'active':'' " ng-click="map.show_amount = !map.show_amount">%</div>
	                        <div ng-class="map.show_amount ? 'active':'' " ng-click="map.show_amount = !map.show_amount">$</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="how-to-read">
	            <div ng-if="map.show_how">
	            	This is the geographic allocation of your investments. All impact investments in Andorra choose impact areas. Investments may have one impact area or rank multiple impact areas.
	            </div>
	        </div>
	    </div>

	    <div class="col-md-12">
		    <div class="row">
		    	<div class="col-md-9">
		    		 <div id="reco">
					    <div svg-map-world-portfolio question-id="0" ng-if="geo_allocation"></div>
					</div>
		    	</div>
		    	<div class="col-md-3 ">
		    		<div class="profile">
			    		<table>
			                <tr ng-repeat="geo in map.data.real_allocation.international">
			                    <td>@{{geo.name}}</td>
			                    <td ng-if="!map.show_amount">@{{geo.allocation}}%</td>
			                    <td ng-if="map.show_amount">@{{geo.amount | currency}}</td>
			                </tr>
			                <tr ng-repeat="geo in map.data.real_allocation.us">
			                    <td>@{{geo.name}}</td>
			                    <td ng-if="!map.show_amount">@{{geo.allocation}}%</td>
			                    <td ng-if="map.show_amount">@{{geo.amount | currency}}</td>
			                </tr>
			            </table>
		            </div>
		    	</div>
		    </div>
	    </div>
	</div>
</div>