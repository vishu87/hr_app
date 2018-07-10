<div class="details" style="margin-top: 20px">
    <div class="chart-details">
        <div class="item" ng-repeat="item in {{$data}}" ng-if="item.value != 0">
            <div class="table item-table">
                <div class="">
                    @{{item.name}}
                </div>
                <div class=" text-right">
                    @{{item.value}}%
                </div>
            </div>
            <div class="bar-line">
                <div style="width: @{{item.value}}%; background: <?php echo '{{'.$colors.'[$index]}}' ?>"></div>
            </div>
        </div>
    </div>
</div>