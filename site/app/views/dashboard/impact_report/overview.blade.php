<div class="impact-overview" id="overview">
	<div class="row">
		<div class="col-md-6">
			<div class="impact-sec">
				<h3>Total Impact Dollars</h3>
				<div>
					@{{overview.total_impact_dollars | currency}}
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="impact-sec grey">
				<h3>Unknown</h3>
				<div>
					@{{overview.unknown_dollars | currency}}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="impact-sec">
				<h3># of Impact Investments</h3>
				<div>
					@{{overview.no_of_impact_investments}}
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="impact-sec grey">
				<h3>Unknown</h3>
				<div>
					@{{overview.unknown_investments}}
				</div>
			</div>
		</div>
	</div>
</div>