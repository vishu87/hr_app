<div ng-if="type == 8">
    
    <div style="width: 300px; margin: 0 auto">
        <div e-pie-chart dataid="financial_versus_impact_allocation" dataname="Current" datagraph = "financial_versus_impact_allocation" ng-if="financial_versus_impact_allocation" class="andorra-chart" style="height: 300px" colors="financial_versus_impact_colors"></div>
        <?php $data = "financial_versus_impact_allocation"; $colors = "financial_versus_impact_colors" ?>
        @include('dashboard.investor.compare.details')
        
    </div>
    <div style="clear: both;"></div>
</div>