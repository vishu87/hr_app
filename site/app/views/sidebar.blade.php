
<li class="sidebar-toggler-wrapper hide">
    <div class="sidebar-toggler">
        <span></span>
    </div>
</li>

<li class="nav-item start {{($sidebar =='dashboard')?'active':''}}">
    <a href="{{url('/dashboard')}}" class="nav-link">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
    </a>
</li>


<li class="nav-item {{($sidebar =='jobs')?'active':''}}">
    <a href="{{url('/jobs')}}" class="nav-link">
        <i class="icon-users"></i>
        <span class="title">Jobs</span>
        <span class="selected"></span>
    </a>
</li>


<li class="nav-item {{($sidebar =='questionnaire')?'active':''}}">
    <a href="{{url('/questionnaire')}}" class="nav-link">
        <i class="icon-list"></i>
        <span class="title">Questionnaire</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{($sidebar == 'administration')?'active':''}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-settings"></i>
        <span class="title">Administration</span>
        <span class="arrow {{($sidebar =='administration')?'open':''}}"></span>
    </a>
    <ul class="sub-menu" @if($sidebar =='administration') style="display: block;" @endif>
         <li class="nav-item @if($sidebar =='administration' && $subsidebar == 'settings') active @endif">
            <a href="{{url('/admin/settings')}}" class="nav-link ">
                <span class="title">Settings</span>
            </a>
        </li>
    </ul>
</li>