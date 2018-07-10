@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar')
    <div class="investor-results" ng-controller="investorImpactCtrl" style="margin-top: 20px">
        <div class="profile container-fluid">
            @include('dashboard.investor.impact')
        </div>
    </div>
</main>

@include('footer')