<div class="details" style="margin-top: 20px">
    <div class="chart-details">
        <div class="item" ng-repeat="item in {{$data}}" ng-if="item.value != 0">
            <div class="table item-table">
                <div class="">
                    @{{item.name}}
                </div>
                <div class=" text-right" ng-if="!graph.show_amount">
                    @{{item.perc}}%
                </div>
                <div class=" text-right" ng-if="graph.show_amount">
                    @{{item.value | currency}}
                </div>
            </div>
            <div class="bar-line">
                <div style="width: @{{item.perc}}%; background: @{{item.color}} "></div>
            </div>
        </div>
    </div>
</div>