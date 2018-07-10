<div ng-if="type == 7">
    <div style="width: 300px; margin: 0 auto">
        <div e-pie-chart dataid="category_allocation" dataname="Current" datagraph = "category_allocation" ng-if="category_allocation" class="andorra-chart" style="height: 300px" colors="category_allocation_colors"></div>
        <?php $data = "category_allocation"; $colors = "category_allocation_colors" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>