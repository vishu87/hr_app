<div class="row">

    <div class="col-md-12" style="position:relative">
        <div class="row">
            <div class="col-md-8">
                <h2>@{{graph.name}} 
                    <span class="plus-icon" ng-click="graph.show_how = !graph.show_how">
                        <i class="fa fa-info-circle"></i>
                    </span>
                </h2>
            </div>
            <div class="col-md-4 text-right">
                <div class="switch-box">
                    <div class="table">
                        <div ng-class="!graph.show_amount ? 'active':'' " ng-click="graph.show_amount = !graph.show_amount">%</div>
                        <div ng-class="graph.show_amount ? 'active':'' " ng-click="graph.show_amount = !graph.show_amount">$</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="how-to-read" ng-if="graph.how_to_read">
            <div ng-bind-html="graph.how_to_read" ng-if="graph.show_how"></div>
        </div>
    </div>

    <div class="col-md-4">
        <h3 class="dd-title">@{{graph.double_donut_series1_header}}</h3>
        <?php $data = "this[graph.term].series1";?>
        <div id="@{{graph.term}}_1">
            @include('dashboard.investor.compare.details_dd')
        </div>
    </div>

    <div class="col-md-4">
        <div class="table chart-table">
            <div class="chart small">
                <div e-chart-double dataid="@{{graph.term}}" dataname="" datagraph = "@{{graph.term}}" colors="colors"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h3 class="dd-title">@{{graph.double_donut_series2_header}}</h3>
        <?php $data = "this[graph.term].series2";?>
        <div id="@{{graph.term}}_2">
            @include('dashboard.investor.compare.details_dd')
        </div>
    </div>

</div>