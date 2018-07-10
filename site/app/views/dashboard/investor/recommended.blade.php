<div class="row">
    <div class="col-md-9">

        <div style="height: 20px"></div>

        <div class="recos" ng-show="asset_classes.length > 0">

            <div class="recommendation" ng-repeat="asset_class in asset_classes">
                <div class="andorra-title">
                    <div>
                        <div class="title">@{{asset_class.asset_class}}</div>
                    </div>
                </div>


                <div class="investments" ng-if="asset_class.sub_asset_allocation.length == 0">
                    <table class="table portfolio-table" ng-if="asset_class.investments.length > 0">
                        <thead>
                            <tr>
                                <td >Investment</td>
                                <td style="width: 150px">Amount</td>
                                <td style="width: 80px" class="center">% of portfolio</td>
                                <td style="width: 150px" class="center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="investment in asset_class.investments">
                                @include('dashboard.investor.recommended_item_list')
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <td >
                                    <span>@{{(portfolio_amount*asset_class.allocation/100).toFixed(2) | currency}}</span>
                                </td>
                                <td class="center">
                                    @{{asset_class.allocation}} %
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div ng-if="asset_class.investments.length == 0"> No investments found</div>
                </div>



                <div class="investments" ng-if="asset_class.sub_asset_allocation.length > 0">
                    <div class="" ng-repeat="sub_asset_class in asset_class.sub_asset_allocation" style="margin-bottom: 5px; padding-bottom: 5px; border-bottom: 1px solid #EEE">
                        <div style="font-size: 14px; font-weight: bold; margin-bottom: 5px">@{{sub_asset_class.sub_asset_class}}</div>
                        <table class="table portfolio-table" ng-if="sub_asset_class.investments.length > 0">
                            <thead>
                                <tr>
                                    <td >Investment</td>
                                    <td style="width: 150px">Amount</td>
                                    <td style="width: 80px" class="center">% of portfolio</td>
                                    <td style="width: 150px" class="center"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="investment in sub_asset_class.investments">
                                    @include('dashboard.investor.recommended_item_list')
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <td >
                                        <span>@{{(portfolio_amount*asset_class.allocation/100).toFixed(2) | currency}}</span>
                                    </td>
                                    <td class="center">
                                        @{{sub_asset_class.allocation}} %
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div ng-if="sub_asset_class.investments.length == 0"> No investments found</div>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="home-sidebar">
            <div class="portfolio-amount">
                <div class="table">
                    <div class="img"><img src="{{url('assets/svg/Coins-3.svg')}}"></div>
                    <div>Ideal Investment Size</div>
                </div>
                @{{portfolio_amount | currency}}
            </div>
            <hr>
            <div style="text-align:center">
                New to Impact Investment? <br> <a href="{{url('/history')}}">Learn More</a>
            </div>
        </div>
    </div>
</div>

@include('dashboard.investor.amount_modal')