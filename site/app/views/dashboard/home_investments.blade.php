@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar_home')
	<div class="container-fluid">
		<div class="row" ng-controller="investorDashboardCtrl">
			<div class="col-md-9">

				<div style="height: 20px"></div>

				<div class="hidden">
				    <div class="recos">
				        <div class="recommendation">
				            <div class="row andorra-title">
				            	<div class="col-md-8 no-pad-left">
				            		<div class="title">Andorra Recommended Investments</div>
				            	</div>
				            	<div class="col-md-4">
				            		<div class="link">
				            			<a href="{{url('investor/recommendations')}}">View All <i class="fa fa-angle-double-right"></i></a>
				            		</div>
				            	</div>
				            </div>
				            <div class="investments">
				                <div class="investment" ng-repeat="investment in reco_investments">
				                    @include('dashboard.investor.recommendation_item')
				                </div>
				            </div>
				        </div>
				    </div>
				</div>

				<div style="height: 40px; display: none"></div>

				<div>
				    <div class="recos">
				        <div class="recommendation">
				            <div class="row andorra-title">
				            	<div class="col-md-8 no-pad-left">
				            		<div class="title">Your Portfolio</div>
				            	</div>
				            	<div class="col-md-4">
				            		<div class="link">
				            			<a href="{{url('investor/portfolio')}}">View All <i class="fa fa-angle-double-right"></i></a>
				            		</div>
				            	</div>
				            </div>
				            <div class="investments" ng-if="portfolios.length > 0">
				                <div class="investment" ng-repeat="investment in portfolios">
				                    @include('dashboard.investor.recommendation_item')
				                </div>
				            </div>
				            <div ng-if="portfolios.length == 0" style="text-align:center; font-size: 20px">
				            	<img src="{{url('assets/svg/Shopping-Cart.svg')}}">
				                Your portfolio is empty. Build your portfolio? <a href="{{url('investor/search')}}">Search</a> for investments or choose from <a href="{{url('investor/recommendations')}}">Andorra recommendations</a>
            				</div>
				        </div>
				    </div>
				</div>

			</div>
			<div class="col-md-3">
				<div class="home-sidebar">
					<div class="portfolio-amount">
						<div class="table">
							<div class="img"><img src="{{url('assets/svg/Coins-3.svg')}}"></div>
							<div>Your Portfolio</div>
						</div>
						@{{portfolio_amount | currency}}
					</div>
					<hr>
					<div class="trending">
						@include('dashboard.trending')
					</div>
					<hr>
					<a class="btn green btn-block" href="{{url('investor/questionnaire/1')}}">
			            Additional questions
			        </a>
			        <hr>
					<div style="text-align:center">
						New to Impact Investment? <br> <a href="{{url('/history')}}">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('copyright')
</main>
@include('footer')