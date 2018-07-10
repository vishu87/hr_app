@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak" ng-controller="HistoryUserCtrl">
    @include('dashboard.title_bar')
    <div class="history-tabs">
        <ul>
            <li ng-class="tab == 1? 'active' : '' ">
                <a href="javascript:;" ng-click="tab=1">History</a>
            </li>
            <li ng-class="tab == 2? 'active' : '' ">
                <a href="javascript:;" ng-click="tab=2">Glossary</a>
            </li>
        </ul>
    </div>
    <div class="timelines" ng-show="tab==1">
        <?php $count = 0; ?>
        @foreach($history_data as $history)
            <div>
                @if($count++ % 2 == 0 )
                <div class="left"></div>
                <div class="right">
                    <div class="circle" style="border-color: {{$colors[$count%$color_count]}}"></div>
                    <div class="item">
                        <div class="time" >
                            <div class="value" style="background: {{$colors[$count%$color_count]}}">{{$history->year}}</div>
                            <div class="marker" style="border-right-color: {{$colors[$count%$color_count]}}"></div>
                        </div>
                        <div class="text">
                            {{$history->content}}
                        </div>
                    </div>
                </div>
                @else
                <div class="left">
                    <div class="circle" style="border-color: {{$colors[$count%$color_count]}}"></div>
                    <div class="item">
                        <div class="text">
                            {{$history->content}}
                        </div>
                        <div class="time">
                            <div class="value" style="background: {{$colors[$count%$color_count]}}">{{$history->year}}</div>
                            <div class="marker"  style="border-left-color: {{$colors[$count%$color_count]}}"></div>
                        </div>
                    </div>
                </div>
                <div class="right"></div>
                @endif
            </div>
        @endforeach

    </div>

    <div class="definitions container" ng-show="tab==2">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:200px">Term</th>
                    <th>Definition</th>
                </tr>
            </thead>
            <tbody>
                @foreach($glossaries as $gl)
                    @if($gl->content != '')
                    <tr>
                        <td>{{$gl->name}}</td>
                        <td>{{$gl->content}}</td>
                    </tr>
                    @endif
                @endforeach
                @foreach($subtags as $subtag)
                    @if($subtag->remarks != '')
                    <tr>
                        <td>{{$subtag->subtag_name}}</td>
                        <td>{{$subtag->remarks}}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @include('copyright')
</main>

@include('footer')