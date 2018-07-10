<div class="side-nav">
	<div class="menu" style="overflow-y: auto">
		<div style="text-align:right">
			<a href="#" class="close-btn"><i class="fa fa-times-circle"></i></a>
		</div>
		<ul>
			<li class="iiPlanning main-li @if(isset($tab)) @if($tab == 1) open @endif @endif ">
				<a href="javascript:;">iiPlanning<sup style="font-size: 10px">TM</sup><span class="selected"></span></a>
				@if(isset($subtab))
				<ul>
					<li @if($tab == 1 && $subtab == 1) class="active" @endif><a href="{{url('investor/questionnaire')}}">Questionnaire</a></li>
					<li @if($tab == 1 && $subtab == 2) class="active" @endif><a href="{{url('investor/what-you-own')}}">Impact Assessment</a></li>
					<li @if($tab == 1 && $subtab == 3) class="active" @endif><a href="{{url('investor/profile')}}">Profile</a></li>
					<li @if($tab == 1 && $subtab == 4) class="active" @endif><a href="{{url('investor/strategy')}}">Strategy</a></li>
					<li @if($tab == 1 && $subtab == 5) class="active" @endif><a href="{{url('investor/portfolio')}}">Holdings</a></li>
				</ul>
				@endif
			</li>

			<li class="iiDatabase main-li  @if(isset($tab)) @if($tab == 2) open @endif @endif ">
				<a href="javascript:;">iiDatabase<sup style="font-size: 10px">TM</sup><span class="selected"></span></a>
				@if(isset($subtab))
					<ul>
						<li @if($tab == 2 && $subtab == 1) class="active" @endif><a href="{{url('investor/search')}}">Investments Map</a></li>
					</ul>
				@endif
			</li>

			<li class="iiReporting main-li @if(isset($tab)) @if($tab == 3) open @endif @endif ">
				<a href="javascript:;">iiReporting<sup style="font-size: 10px">TM</sup><span class="selected"></span></a>
				@if(isset($subtab))
					<ul>
						<li @if($tab == 3 && $subtab == 1) class="active" @endif><a href="{{url('investor/impact-report-new')}}">Impact Reporting</a></li>
						<li @if($tab == 3 && $subtab == 2) class="active" @endif><a href="{{url('investor/financial-report')}}">Financial Reporting</a></li>
					</ul>
				@endif
			</li>

			<li class="iiAnalytics main-li @if(isset($tab)) @if($tab == 4) open @endif @endif ">
				<a href="javascript:;">iiAnalytics<sup style="font-size: 10px">TM</sup><span class="selected"></span></a>
				@if(isset($subtab))
					<ul>
						<li @if($tab == 4 && $subtab == 1) class="active" @endif><a href="{{url('investor/investment-analytics')}}">Investment Analytics</a></li>
					</ul>
				@endif
			</li>
			
		</ul>
	</div>

</div>