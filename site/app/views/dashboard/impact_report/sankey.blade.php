<div>
    <div>
        <h2>
            @{{graph.name}}
            <span class="plus-icon" ng-click="graph.show_how = !graph.show_how">
                <i class="fa fa-info-circle"></i>
            </span>
        </h2>
        <div class="how-to-read" ng-if="graph.how_to_read">
            <div ng-bind-html="graph.how_to_read" ng-if="graph.show_how"></div>
        </div>
    </div>
    <div style="margin-top: 20px;">
        <div class="sankey-titles">
            <div class="first">
                @{{graph.sankey_header1}}
            </div>
            <div class="second">
                @{{graph.sankey_header2}}
            </div>
            <div class="third">
                @{{graph.sankey_header3}}
            </div>
        </div>
        <div e-chart-sankey dataid="@{{graph.term}}" dataname="" datagraph = "@{{graph.term}}" colors="colors"></div>
    </div>
</div>