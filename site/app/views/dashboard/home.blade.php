@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar_home')
    <div class="container investor-results investor-home" ng-controller="resultCtrl" ng-init="tab_id = 1">

        <div id="va-accordion" class="va-container">
				<div class="va-nav">
					<span class="va-nav-prev">Previous</span>
					<span class="va-nav-next">Next</span>
				</div>
				<div class="va-wrapper">
					<div class="va-slice va-slice-1">
						<h3 class="va-title {{(Auth::user()->profile_status >= 1)?'check':'exclamation'}}">
							Profile
						</h3>
						<div class="va-content">
							<p>Congratulations on completing the questionnaire to build your Investor profile on Andorra</p>
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('investor/profile')}}" class="btn green-v block">View Profile</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('investor/questionnaire/1')}}" class="btn green-v block">Strengthen Profile</a>
								</div>
							</div>
						</div>
					</div>
					<div class="va-slice va-slice-2">
						<h3 class="va-title {{(Auth::user()->profile_status >= 2)?'check':'exclamation'}}">Strategy</h3>
						<div class="va-content">
							<p>Andorra has built your personalized investment strategy. Please choose from the options below as your next step</p>
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('investor/strategy')}}" class="btn blue-v block">Check your Investment Strategy</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('investor/questionnaire/1')}}" class="btn blue-v block">Answer more questions to improve Strategy</a>
								</div>
							</div>
						</div>
					</div>
					<div class="va-slice va-slice-3">
						<h3 class="va-title {{(Auth::user()->profile_status >= 3)?'check':'exclamation'}}">Invest</h3>
						<div class="va-content">
							<p>Awesome! You're now ready to create Impact in the world! Choose from the following methods to select your investments</p>
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('investor/recommendations')}}" class="btn gb-v block">Choose from Andorra Recommendations</a>
								</div>
								<div class="col-md-6">
									<a href="{{url('investor/search')}}" class="btn gb-v block">Search Andorra Investment Database</a>
								</div>
							</div>
						</div>
					</div>
					<div class="va-slice va-slice-4">
						<h3 class="va-title minus">Reporting</h3>
						<div class="va-content">
							<p>You have no investments yet! Once you invest you can receive Impact reports and Financial reports anytime you like</p>
						</div>
					</div>
					
				</div>
		</div>

    </div>
    @include('copyright')
</main>

@include('footer')