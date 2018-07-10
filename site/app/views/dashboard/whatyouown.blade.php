@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar')
    <div ng-controller="investorOwnCtrl">
        <div class="container-fluid">
            @include('dashboard.investor.whatyouown')
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')