@include('front-end.header')
<div  ng-controller="HomeController">
    <div class="menu">
        <ul>
            <li><a href="javascript:;" ng-click="loginModalEntrepreneur()">Raising Capital?</a></li>
            <li><a href="#">About Us</a></li>
            @if(!Auth::check())
                <li class="link"><a href="javascript:;" ng-click="login()">Login</a></li>
            @else
                <li class="user">
                    <a href="javascript:;">{{Auth::user()->username}} <i class="fa fa-angle-down"></i></a>
                    <ul>
                        <li>
                            <a href="{{url('/dashboard')}}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{url('/logout')}}">Logout</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>

    <button ng-click="loginModal()">New User</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>SN</th>
            <th>Title</th>
            <th>Location</th>
            <th>Apply</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 0; ?>
        @foreach($jobs as $job)
        <tr>
            <td>{{++$count}}</td>
            <td>{{$job->title}}</td>
            <td>{{$job->location}}</td>
            <td>
                @if(Auth::check())
                    <a class="btn green uppercase" href="{{url('/users/questionnaire/'.$job->questionnaire_id)}}">Apply</a>
                @else
                    <a class="btn green uppercase" ng-click="login()">Apply</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="loginModal" class="modal fade" role="dialog" ng-controller="RegistrationCtrl" ng-init="type = 2">
	@include('front-end.modals.register')
</div>
<div id="login" class="modal fade" role="dialog" ng-controller="LoginCtrl">
    @include('front-end.modals.login')
</div>

@include('front-end.footer')