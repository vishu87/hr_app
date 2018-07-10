@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak" ng-controller="investmentAnalyticsCtrl">
	@include('dashboard.title_bar')
    <div class="container-fluid">
    	<div class="loading" ng-show="loading" style=""></div>
        <div class="" ng-show="!loading">
        	@include('dashboard.investor.analytics')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')