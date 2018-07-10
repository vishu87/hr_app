<div class="inner-nav">
    <div class="">
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-5">
                <div class="header-menu">
                    
                    <ul>
                        @if(Auth::user()->privilege != 4)
                        <li>
                            <a href="{{url('investor/home')}}">Dashboard</a>
                        </li>
                        @endif
                        @if($default_header != 2)
                            @if(!Input::has("ref"))
                            <li>
                                <a href="{{url('investor/search')}}">Explore</a>
                                <ul>
                                    <li>
                                        <a href="{{url('investor/andorra-recommended-portfolio')}}">Recommended Portfolio</a>
                                    </li>
                                    <li>
                                        <a href="{{url('investor/recommendations')}}">Top Matches</a>
                                    </li>
                                    <li>
                                        <a href="{{url('investor/search')}}">Investments Map</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{url('investor/portfolio')}}">Holdings</a>
                            </li>
                            @endif
                        @endif
                    </ul>
                    
                </div>
            </div>

            <div class="col-md-4">
                <div class="username">
                    @if(Session::has('advisor_id') && Auth::user()->privilege == 2)
                        <a href="{{url('loginAsAdvisor')}}/{{Session::get('advisor_id')}}" class="btn green btn-sm" style="margin-right:10px">Advisor Portal</a>    
                    @endif
                    <img src="{{url('front-end/img/avatar.png')}}" class="profile-img">
                    &nbsp;
                    {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                    <i class="fa fa-angle-down"></i>
                    <ul>
                        <li>
                            <a href="{{url('/logout')}}"><i class="fa fa-key"></i> Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>