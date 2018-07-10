@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak" ng-controller="investorPortfolioCtrl">
	@include('dashboard.title_bar')
    <div>
        <div class="container-fluid">
            @include('dashboard.investor.portfolio')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')