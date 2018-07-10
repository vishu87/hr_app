@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak" ng-controller="investorStrategyCtrl">
	@include('dashboard.title_bar')
    <div class="container investor-results" style="margin-bottom:50px">
    	<div class="loading" ng-show="loading" style=""></div>
        <div class="profile" ng-show="!loading">
        	@include('dashboard.investor.strategy')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')