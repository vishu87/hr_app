<div ng-if="type == 6">
    <h2 class="impact-heading" ng-if="show_strategy">UN SDG</h2>
    <div style="width: 300px; float: left;" ng-class="show_strategy ? '' : 'center-content' ">
        <div e-pie-chart dataid="un_goals_allocation" dataname="Current" datagraph = "un_goals_allocation" ng-if="un_goals_allocation" class="andorra-chart" style="height: 300px" colors="un_goals_colors"></div>
        <?php $data = "un_goals_allocation"; $colors = "un_goals_colors" ?>
        @include('dashboard.investor.compare.details')
        
    </div>
    <div style="width: 300px; float: right;" ng-if="show_strategy">
        <div e-pie-chart dataid="un_goals_allocation_andorra" dataname="Target" datagraph = "un_goals_allocation_andorra" ng-if="un_goals_allocation_andorra" class="andorra-chart" style="height: 300px" colors="un_goals_colors_andorra"></div>
        <?php $data = "un_goals_allocation_andorra"; $colors = "un_goals_colors_andorra" ?>
        @include('dashboard.investor.compare.details')
    </div>
    <div style="clear: both;"></div>
</div>