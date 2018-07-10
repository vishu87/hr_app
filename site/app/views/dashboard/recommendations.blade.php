@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak" ng-controller="investorRecommendationCtrl">
	@include('dashboard.title_bar')
    <div class="investor-results">
        <div class="profile container-fluid" ng-show="!map_view">
            @include('dashboard.investor.recommendation')
        </div>
        <div class="profile container-fluid" ng-show="map_view">
            @include('dashboard.investor.recommendation_map')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')