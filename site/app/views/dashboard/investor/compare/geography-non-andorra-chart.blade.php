<div ng-if="type == 5">
    <h2 class="impact-heading" ng-if="show_strategy">Geography</h2>
    <div style="width: 300px; float: left;" ng-class="show_strategy ? '' : 'center-content' ">
        <div e-pie-chart dataid="location_based" dataname="Current" datagraph = "location_based" ng-if="location_based" class="andorra-chart" style="height: 300px" colors="location_colors"></div>
        <?php $data = "location_based"; $colors = "location_colors" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="width: 300px; float: right;" ng-if="show_strategy">
        <div e-pie-chart dataid="location_based_andorra" dataname="Target" datagraph = "location_based_andorra" ng-if="location_based_andorra" class="andorra-chart" style="height: 300px" colors="location_colors_andorra"></div>
        <?php $data = "location_based_andorra"; $colors = "location_colors_andorra" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>