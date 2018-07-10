<div ng-if="type == 3">
    <h2 class="impact-heading" ng-if="show_strategy">Impact Sectors</h2>
    <div style="width: 300px; float: left;" ng-class="show_strategy ? '' : 'center-content' ">
        <div e-pie-chart dataid="sector_allocation" dataname="Current" datagraph = "sector_allocation" ng-if="sector_allocation" class="andorra-chart" style="height: 300px" colors="sector_colors"></div>
        <?php $data = "sector_allocation"; $colors = "sector_colors" ?>
        @include('dashboard.investor.compare.details')
        
    </div>
    <div style="width: 300px; float: right;" ng-if="show_strategy">
        <div e-pie-chart dataid="sector_allocation_andorra" dataname="Target" datagraph = "sector_allocation_andorra" ng-if="sector_allocation_andorra" class="andorra-chart" style="height: 300px" colors="sector_colors_andorra"></div>
        <?php $data = "sector_allocation_andorra"; $colors = "sector_colors_andorra" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>