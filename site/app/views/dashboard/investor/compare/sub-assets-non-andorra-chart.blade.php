<div ng-if="type == 2">
    <h2 class="impact-heading" ng-if="show_strategy">Impact Assets</h2>
    <div style="width: 300px; float: left;" ng-class="show_strategy ? '' : 'center-content' ">
        <div e-pie-chart dataid="sub_asset_class_allocation" dataname="Current" datagraph = "sub_asset_class_allocation" ng-if="sub_asset_class_allocation" class="andorra-chart" style="height: 300px" colors="sub_asset_colors"></div>
        <?php $data = "sub_asset_class_allocation"; $colors = "sub_asset_colors" ?>
        @include('dashboard.investor.compare.details')
        
    </div>
    <div style="width: 300px; float: right;" ng-if="show_strategy">
        <div e-pie-chart dataid="sub_asset_class_allocation_andorra" dataname="Target" datagraph = "sub_asset_class_allocation_andorra" ng-if="sub_asset_class_allocation_andorra" class="andorra-chart" style="height: 300px" colors="sub_asset_colors_andorra"></div>
        <?php $data = "sub_asset_class_allocation_andorra"; $colors = "sub_asset_colors_andorra" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>