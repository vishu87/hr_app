<div ng-if="type == 4">
    <h2 class="impact-heading" ng-if="show_strategy">Impact Industries</h2>
    <div style="width: 300px; float: left;" ng-class="show_strategy ? '' : 'center-content' " >
        <div e-pie-chart dataid="industry_allocation" dataname="Current" datagraph = "industry_allocation" ng-if="industry_allocation" class="andorra-chart" style="height: 300px" colors="industry_colors"></div>
        <?php $data = "industry_allocation"; $colors = "industry_colors" ?>
        @include('dashboard.investor.compare.details')
        
    </div>
    <div style="width: 300px; float: right;" ng-if="show_strategy">
        <div e-pie-chart dataid="industry_allocation_andorra" dataname="Target" datagraph = "industry_allocation_andorra" ng-if="industry_allocation_andorra" class="andorra-chart" style="height: 300px" colors="industry_colors_andorra"></div>
        <?php $data = "industry_allocation_andorra"; $colors = "industry_colors_andorra" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>