@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak" ng-controller="investorSearchCtrl">
	@include('dashboard.title_bar_search')
    <div class="investor-results">
        <div class="profile">
            @include('dashboard.investor.search')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')