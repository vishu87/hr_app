@include('header')
@include('navigation')
<main class="ng-cloak">
    <div class="container investor-results" ng-controller="resultCtrl" ng-init="tab_id = 1">
        <div class="" style="margin-top: 30px; margin-bottom: 30px">
            <ul class="nav nav-tabs">
                <li class="@{{(tab_id==1)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(1)">Your Profile</a>
                </li>
                <li class="@{{(tab_id==2)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(2)">Strategy</a>
                </li>
                <li class="@{{(tab_id==3)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(3)">Search Investments</a>
                </li>
                <li class="@{{(tab_id==4)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(4)">Recommendations</a>
                </li>
                <li class="@{{(tab_id==5)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(5)">Portfolio</a>
                </li>
                <li class="@{{(tab_id==6)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(6)">Financial Report</a>
                </li>
                <li class="@{{(tab_id==7)?'active':''}}">
                    <a href="javascript:;" ng-click="changeTab(7)">Impact Report</a>
                </li>
            </ul>
        </div>
        <div class="profile" ng-show="tab_id == 1">
            @include('dashboard.investor.profile')
        </div>

        <div ng-show="tab_id == 2">
            @include('dashboard.investor.strategy')
        </div>

        <div ng-show="tab_id == 3">
            @include('dashboard.investor.search')
        </div>

        <div ng-show="tab_id == 4">
            @include('dashboard.investor.recommendation')
        </div>

        <div ng-show="tab_id == 5">
            @include('dashboard.investor.portfolio')
        </div>

        <div ng-show="tab_id == 6">
            @include('dashboard.investor.financial')
        </div>

        <div ng-show="tab_id == 7">
            @include('dashboard.investor.impact')
        </div>

    </div>
    @include('copyright')
</main>

@include('footer')