<section class="andorra">
    <div class="tooltipMap" ng-show="displayTooltip"></div>
    <h1>
        <a href="javascript:;" class="tooltip-link {{(isset($glossary[21])) ? ($glossary[21] != '') ? 'has-remarks' : '' :''}}" tooltips tooltip-template="{{ (isset($glossary[21])) ? $glossary[21] : ''}}">Risk Score</a>
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="slide-mark">
                <div class="circle" style="left: @{{risk_score*10}}%">@{{risk_score}}</div>
                <div class="line"></div>
            </div>

        </div>
    </div>
    <h1>
        <a href="javascript:;" class="tooltip-link {{(isset($glossary[12])) ? ($glossary[12] != '') ? 'has-remarks' : '' :''}}" tooltips tooltip-template="{{ (isset($glossary[12])) ? $glossary[12] : ''}}">Asset Allocation</a>
    </h1>
    <div class="row">
        <div class="col-md-6">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title">
                        <span tooltips tooltip-template="{{ (isset($glossary[17])) ? $glossary[17] : ''}}">Assets</span>
                    </div>
                    <div e-chart-small dataid="major_asset" titlehide="true" dataname="Assets" datagraph = "major_asset_class_allocation" ng-if="major_asset_class_allocation" colors="major_asset_colors"></div>
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in major_asset_class_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{major_asset_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title">
                        <span tooltips tooltip-template="{{ (isset($glossary[15])) ? $glossary[15] : ''}}">Sub Assets</span>
                    </div>
                    <div e-chart-small dataid="assets" titlehide="true" dataname="Sub Assets" datagraph = "asset_class_allocation" ng-if="asset_class_allocation" colors="asset_class_colors"></div>
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in asset_class_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{asset_class_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title">
                        <span tooltips tooltip-template="{{ (isset($glossary[16])) ? $glossary[16] : ''}}">Impact Assets</span>
                    </div>
                    <div e-chart-small dataid="sub_asset" titlehide="true" dataname="Impact Assets" datagraph = "sub_asset_class_allocation" ng-if="sub_asset_class_allocation" colors="sub_asset_colors"></div>  
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in sub_asset_class_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{sub_asset_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title two-line">
                        <span tooltips tooltip-template="{{ (isset($glossary[17])) ? $glossary[17] : ''}}">Liquidity<br>Preference</span>
                    </div>
                    <div e-chart-small dataid="liquidity_preference_allocation" titlehide="true" dataname="Liquidity Preference" datagraph = "liquidity_preference_allocation" ng-if="liquidity_preference_allocation" colors="liquidity_preference_colors"></div>
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in liquidity_preference_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{liquidity_preference_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h1>
        <a href="javascript:;" class="tooltip-link {{(isset($glossary[13])) ? ($glossary[13] != '') ? 'has-remarks' : '' :''}}" tooltips tooltip-template="{{ (isset($glossary[13])) ? $glossary[13] : ''}}">Impact Allocation</a>
    </h1>
    <div class="row">
        <div class="col-md-6">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title">
                        <span tooltips tooltip-template="{{ (isset($glossary[18])) ? $glossary[18] : ''}}">Impact Sector</span>
                    </div>
                    <div e-chart-small dataid="sector_allocation" titlehide="true" dataname="Impact Sector" datagraph = "sector_allocation" ng-if="sector_allocation" colors="sector_colors"></div>   
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in sector_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{sector_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title two-line">
                            <span tooltips tooltip-template="{{ (isset($glossary[19])) ? $glossary[19] : ''}}">Impact<br>Industry</span>
                        </div>
                    <div e-chart-small dataid="industry_allocation" titlehide="true" dataname="Impact Industry" datagraph = "industry_allocation" ng-if="industry_allocation" colors="industry_colors"></div>
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in industry_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{industry_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 ">
            <div class="table chart-table">
                <div class="chart small">
                    <div class="title">
                        <span tooltips tooltip-template="{{ (isset($glossary[20])) ? $glossary[20] : ''}}">UN SDG</span>
                    </div>
                    <div e-chart-small dataid="un_goals_allocation" titlehide="true" dataname="UN SDG" datagraph = "un_goals_allocation" ng-if="un_goals_allocation" colors="un_goals_colors"></div>
                </div>
                <div class="details">
                    <div class="chart-details">
                        <div class="item" ng-repeat="item in un_goals_allocation">
                            <div class="table item-table">
                                <div class="">
                                    @{{item.name}}
                                </div>
                                <div class=" text-right">
                                    @{{item.value}}%
                                </div>
                            </div>
                            <div class="bar-line">
                                <div style="width: @{{item.value}}%; background: @{{un_goals_colors[$index]}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h1>
        <a href="javascript:;" class="tooltip-link {{(isset($glossary[14])) ? ($glossary[14] != '') ? 'has-remarks' : '' :''}}" tooltips tooltip-template="{{ (isset($glossary[14])) ? $glossary[14] : ''}}">Geographic Preference</a>
    </h1>
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-md-6 col-md-offset-3">
            <div class="table">
                <div ng-click="show_us = false" class="geo-pref" ng-class="show_us ? '' : 'active' ">@{{international_allocation_perc}}% International</div>
                <div ng-click="show_us = true" class="geo-pref" ng-class="show_us ? 'active' :'' ">@{{us_allocation_perc}}% US</div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-9">
            <div id="reco" ng-show="!show_us">
                <div svg-map-world-portfolio question-id="0" ng-if="geo_allocation"></div>
            </div>
            <div id="reco" ng-show="show_us">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div svg-map-us-portfolio question-id="1" ng-if="geo_allocation"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <table ng-show="!show_us">
                <tr ng-repeat="geo in int_allocation_actual">
                    <td>@{{geo.name}}</td>
                    <td>@{{geo.allocation}}%</td>
                </tr>
            </table>
            <table ng-show="show_us">
                <tr ng-repeat="geo in us_allocation_actual">
                    <td>@{{geo.name}}</td>
                    <td>@{{geo.allocation}}%</td>
                </tr>
            </table>
        </div>

        <div class="col-md-12" style=" margin: 50px 0 100px 0">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="blue-gradient" style="height: 30px;"></div>
                    <div>
                        <div style="float: left;">0</div>
                        <div style="float: right;">100%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(Input::has("ref"))
<div class="btns-div">
    <div style="margin-top: 20px;" ng-if="!hide_confirm" class="hidden">
        <a href="javascript:;" class="btn blue block" ng-click="confirmModal()">Does this look like you?</a>
    </div>

    <div style="margin-top: 20px;" class="row">
        <div class="col-md-6"><a href="{{url('/investor/home')}}" class="btn blue block">Go to Dashboard</a></div>
        <div class="col-md-6"><a href="{{url('/investor/recommendations')}}" class="btn green block">Recommended investments</a></div>
    </div>
</div>
@endif

<div class="policy-document">
    <a href="{{url('assets/files/Impact_Investment_Policy.docx')}}" target="_blank">
        <i class="fa fa-file-word-o" style="color:#2a5699"></i> Generate Policy DOC
    </a>
</div>

<div class="policy-document">
    <a href="{{url('/investor/strategy/create-pdf')}}" target="_blank">
        <i class="fa fa-file-pdf-o"></i> Generate Policy PDF
    </a>
</div>

<div id="strategyModal" class="modal fade in modal-overflow" data-width="500">
    <div class="modal-body">
        <h2>Does this strategy is good?</h2>
        <div class="row">
            <div class="col-md-6">
                <button type="button" ladda="processing" ng-click="confirm(1)" class="btn block green"><i class="fa fa-thumbs-up"></i> Yes</button>
            </div>
            <div class="col-md-6">
                <button type="button" ladda="processing" ng-click="confirm(-1)" class="btn block red"><i class="fa fa-thumbs-down"></i> No</button>
            </div>
        </div>
    </div>
</div>