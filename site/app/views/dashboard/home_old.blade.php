@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
    <div class="container investor-results investor-home" ng-controller="resultCtrl" ng-init="tab_id = 1">

    	<div class="table profile-top">
    		<div class="profile">
	    		<div class="image"></div>
	    		<div class="info">
	    			<div>
	    				<div class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
	    				<div>Microfinancier, Local Investor, Impact Angel Investor</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div>
	    		<a href="#" style="width: 200px; margin-left: 30px; display: block;">Answer more questions for<br>better investment recommendations</a>
	    	</div>
    	</div>

        <div id="va-accordion" class="va-container">
				<div class="va-nav">
					<span class="va-nav-prev">Previous</span>
					<span class="va-nav-next">Next</span>
				</div>
				<div class="va-wrapper">
					<div class="va-slice va-slice-1">
						<h3 class="va-title check">
							Profile
						</h3>
						<div class="va-content">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet</p>
							<div class="row">
								<div class="col-md-6">
									<button class="btn green-v block">View Profile</button>
								</div>
								<div class="col-md-6">
									<button class="btn green-v block">Strengthen Profile</button>
								</div>
							</div>
						</div>
					</div>
					<div class="va-slice va-slice-2">
						<h3 class="va-title exclamation">Strategy</h3>
						<div class="va-content">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet</p>
							<div class="row">
								<div class="col-md-6">
									<button class="btn green-v block">View Profile</button>
								</div>
								<div class="col-md-6">
									<button class="btn green-v block">Strengthen Profile</button>
								</div>
							</div>
						</div>
					</div>
					<div class="va-slice va-slice-3">
						<h3 class="va-title exclamation">Invest</h3>
						<div class="va-content">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet</p>
							<div class="row">
								<div class="col-md-6">
									<button class="btn green-v block">View Profile</button>
								</div>
								<div class="col-md-6">
									<button class="btn green-v block">Strengthen Profile</button>
								</div>
							</div>
						</div>
					</div>
					<div class="va-slice va-slice-4">
						<h3 class="va-title minus">Reporting</h3>
						<div class="va-content">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet</p>
							<div class="row">
								<div class="col-md-6">
									<button class="btn green-v block">View Profile</button>
								</div>
								<div class="col-md-6">
									<button class="btn green-v block">Strengthen Profile</button>
								</div>
							</div>
						</div>
					</div>
					
				</div>
		</div>

    </div>
</main>

@include('footer')