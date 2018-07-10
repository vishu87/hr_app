<div>
    <div class="company" ng-bind="investment.company_name"></div>
    <div class="image" style="background: @{{investment.color}}"></div>
    <h2 ng-bind="investment.product_name"></h2>
    <div class="stats">
        <div class="row">
            <div class="col-md-7">Major Asset Class</div>
            <div class="col-md-5"><span ng-bind="investment.major_asset_class_name"></span></div>
        </div>
        <div class="row">
            <div class="col-md-7">Time Horizon</div>
            <div class="col-md-5"><span>@{{investment.time_horizon_year}} Years</span></div>
        </div>
        <div class="row">
            <div class="col-md-7">Expected Financial Return</div>
            <div class="col-md-5"><span>@{{investment.target_irr}} %</span></div>
        </div>
    </div>
    <div class="invested" ng-show="investment.invested == 1">
        <div class="table">
            <div><a href="javascript:;">Impact Report</a></div>
            <div><a href="javascript:;">Financial Report</a></div>
        </div>
        <div class="remove"><a href="javascript:;">Remove Investment</a></div>
    </div>
    <div class="nt-invested" ng-show="investment.invested != 1">
        <div><a href="javascript:;">Invest</a></div>
    </div>
</div>