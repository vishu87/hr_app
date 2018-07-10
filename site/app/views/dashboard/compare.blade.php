@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar')
    <div class="investor-results" ng-controller="investorCompareCtrl">
        <div style="width:1000px; margin: 0 auto">
            @include('dashboard.investor.compare')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')