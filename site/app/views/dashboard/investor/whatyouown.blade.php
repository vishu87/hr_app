<div class="row">
    <div class="col-md-9">

        <div style="height: 20px"></div>
        <div class="row">
            <div class="col-md-9">
                <div style="margin-top: 5px; font-weight: bold">
                    Please enter the investment name and amount to evaluate the type of impact you are creating
                </div> 
            </div>
            <div class="col-md-3" style="text-align: right;">
                <button type="button" ng-click="addModal()" class="btn blue">Add Investment</button>    
            </div>
        </div>
        <div style="height: 20px"></div>
        

        <table class="table investment-tbl">
            <thead>
                <tr>
                    <th style="width: 50px">SN</th>
                    <th >Investment</th>
                    <th style="width: 250px">Amount</th>
                    <th style="width: 100px"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="investment in investments">
                    <td>@{{$index + 1}}</td>
                    <td class="name">@{{investment.investment_name ? investment.investment_name : investment.product_name}}</td>
                    <td class="amount">@{{investment.amount | currency}}</td>
                    <td>
                        <button type="button" class="btn red" ladda="investment.removing" ng-click="removeInvestment(investment)">Remove</button>
                    </td>
                </tr>
                <tr ng-if="investments.length == 0">
                    <td colspan="4">No investments found</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row impact-overview">
            <div class="col-md-6">
                <div class="impact-sec">
                    <h3>Total Impact Dollars</h3>
                    <div class="ng-binding">
                        @{{identified.amount | currency}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="impact-sec grey">
                    <h3>Unknown</h3>
                    <div class="ng-binding">
                        @{{unidentified.amount | currency}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="impact-sec">
                    <h3># of impact investments</h3>
                    <div class="ng-binding">
                        @{{investments.length - unidentified.investments.length}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="impact-sec grey">
                    <h3>Unknown</h3>
                    <div class="ng-binding">
                        @{{unidentified.investments.length}}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div ng-show="investments.length > 0" class="compare-ttile">
            <div class="row">
                <div ng-if="show_strategy" class="col-md-9 head">Comparison with Andorra Strategy</div>
                <div ng-if="!show_strategy" class="col-md-9 head">Impact of your current portfolio</div>
                <div class="col-md-3" style="text-align: right;">
                    <select ng-model="type">
                        <option ng-value="1">Sub Asset Class</option>
                        <option ng-value="2">Impact Asset Class</option>
                        <option ng-value="3">Impact Sectors</option>
                        <option ng-value="4">Impact Industries</option>
                        <option ng-value="5">Geography</option>
                        <option ng-value="6">UN SDG</option>
                        <option ng-value="7">Investment Category</option>
                        <option ng-value="8">Financial vs Impact</option>
                    </select>
                </div>
            </div>
        </div>
        <div style="margin-top: 50px; position: relative;" ng-show="investments.length > 0">
            @include('dashboard.investor.compare.assets-non-andorra-chart')
            @include('dashboard.investor.compare.sub-assets-non-andorra-chart')
            @include('dashboard.investor.compare.sector-non-andorra-chart')
            @include('dashboard.investor.compare.industry-non-andorra-chart')
            @include('dashboard.investor.compare.geography-non-andorra-chart')
            @include('dashboard.investor.compare.unsdg-non-andorra-chart')
            @include('dashboard.investor.compare.category-non-andorra-chart')
            @include('dashboard.investor.compare.financeimpact-non-andorra-chart')

            <div class="row">
                <div ng-class=" (type == 7 || type == 8 || !show_strategy) ? 'col-md-12' : 'col-md-3' ">
                    <div style="text-align: center; color: #888; width: 300px; margin: 0 auto; margin-top: 20px; " ng-if="unidentified_percentage > 0">
                        *Unknown investments could be investments that are extractive or destructive to the environment and society
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
                    <div>Your Portfolio (Outside Andorra)</div>
                </div>
                @{{ portfolio_amount | currency}}
            </div>
            <hr>
            <div style="text-align:center">
                New to Impact Investment? <br> <a href="{{url('/history')}}">Learn More</a>
            </div>
        </div>
    </div>
</div>

<div id="entryModal" class="modal fade in modal-overflow" data-width="500" style="top:150px">
    <div class="modal-body investment-entry">
        <div style="font-size: 24px; margin-bottom: 10px">
            Add Investment
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 20px">
                <div tabindex="-1" class="input-filter">
                    <input type="text" ng-keyup="user_investment.showdrop = true; user_investment.id = 0" class="form-control" id="user_investment_name" ng-model="user_investment.name" placeholder="Name of investment" autocomplete="off">
                    <ul ng-show="user_investment.showdrop">
                        <li ng-repeat="investment in andorra_investments | filter : {name : user_investment.name}" ng-mousedown="selectInvestment(investment)">
                            @{{investment.name}} (@{{investment.time_horizon_year}} Years), @{{investment.asset_class_name}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 20px">
                <input type="text" ng-model="user_investment.amount" class="form-control" placeholder="Amount">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="button" ladda="adding" ng-click="addInvestment()" class="btn green"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </div>
</div>