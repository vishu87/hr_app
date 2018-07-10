<div ng-if="type == 1">
    <h2 class="impact-heading" ng-if="show_strategy">Sub Assets</h2>
    <div style="width: 300px; float: left;" ng-class="show_strategy ? '' : 'center-content' ">
        <div e-pie-chart dataid="asset_class_allocation" dataname="Current" datagraph = "asset_class_allocation" ng-if="asset_class_allocation" class="andorra-chart" style="height: 300px" colors="asset_class_colors"></div>
        <?php $data = "asset_class_allocation"; $colors = "asset_class_colors" ?>
        @include('dashboard.investor.compare.details')
        
    </div>
    <div style="width: 300px; float: right;" ng-if="show_strategy">
        <div e-pie-chart dataid="asset_class_allocation_andorra" dataname="Target" datagraph = "asset_class_allocation_andorra" ng-if="asset_class_allocation_andorra" class="andorra-chart" style="height: 300px" colors="asset_class_colors_andorra"></div>
        <?php $data = "asset_class_allocation_andorra"; $colors = "asset_class_colors_andorra" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>