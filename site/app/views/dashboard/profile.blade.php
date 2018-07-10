@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak">
	@include('dashboard.title_bar')
    <div class="investor-results" ng-controller="investorProfileCtrl">
    	<div class="loading" ng-show="loading" style=""></div>
        <div class="profile" ng-show="!loading">
            @include('dashboard.investor.profile')
        </div>
        <div ng-show="!loading" class="text-center" style="margin-bottom: 50px">
        	<a class="btn green" href="{{url('investor/questionnaire/1')}}">
                Additional questions
            </a>
        </div>
    </div>
    @include('copyright')
</main>

@include('footer')