@include('header')
@include('navigation')
<main class="ng-cloak" ng-controller="brokerIndexCtrl">
	@include('dashboard.title_bar_broker')
    <div>
        <div class="container-fluid">
            @include('dashboard.broker.index')
        </div>
    </div>
    @include('copyright')
</main>
@include('footer')