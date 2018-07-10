<div class="table title-bar box-shadow">
	<div>
		<div class="float-btn">
			<i class="fa fa-bars"></i>
		</div>
	</div>
	<div class="user-info">
		<div class="table">
			<div class="img">
				<img src="{{url('assets/svg/Male.svg')}}" class="svg-icon">
			</div>
			<div style="padding-left:20px"><div class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
			<div>{{Auth::user()->type_of_investor}}</div></div>
		</div>
	</div>
	
	<div>
		
	</div>
	
</div>