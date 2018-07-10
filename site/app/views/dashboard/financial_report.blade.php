@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar')
    <div class="investor-results" ng-controller="investorFinancialCtrl" style="margin-top: 20px">
        <div class="profile container-fluid">
            @include('dashboard.investor.financial')
        </div>
    </div>
</main>

@include('footer')