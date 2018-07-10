<section style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <label>Vertical Axis</label>
            <select ng-model="vertical_selection" ng-change="changeSelection()" class="form-control" ng-disabled="loading_data">
                <option ng-repeat="vertical in verticalAxis" ng-value="vertical.key" >@{{vertical.value}}</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Horizontal Axis</label>
            <select ng-model="horizontal_selection" ng-change="changeSelection()" class="form-control" ng-disabled="loading_data">
                <option ng-repeat="horizontal in horizontalAxis" ng-value="horizontal.key">@{{horizontal.value}}</option>
            </select>
        </div>
    </div>

    <div>
        <div ng-show="loading_data" style="margin: 50px; text-align: center;">
            Loading
        </div>
        <div ng-show="!loading_data">
            <div class="type-switch">
                <a href="javascript:;" ng-click="type=1" ng-class="type == 1 ? 'active' : '' ">Investments</a>
                <a href="javascript:;" ng-click="type=2" ng-class="type == 2 ? 'active' : '' ">Impact Asset Classes</a>
            </div>
            <div ng-if="matrix" class="matrix">
                <table >
                    <tr ng-repeat="row in matrix">
                        <td ng-repeat="column in row">
                            <div>
                                @{{column.subtag_name}}
                                <span class="investment-count" ng-if="type == 1" ng-click="openDetails(column)">
                                    @{{column.total_no_of_investments > 0 ? column.total_no_of_investments : ''}}
                                </span>
                                <span class="investment-count" ng-if="type == 2" ng-click="openDetails(column)">
                                    @{{column.total_no_of_unique_sub_asset_class > 0 ? column.total_no_of_unique_sub_asset_class : ''}}
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Begin  Modal -->
<div id="analyticsModal" class="modal bs-modal-sm fade in modal-overflow" data-width="500">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Details</h4>
    </div>
    <div class="modal-body" >
        <div ng-if="type == 1">
            <div ng-repeat="investment in modal_investments">
                @{{investment.product_name}}
            </div>
        </div>
        <div ng-if="type == 2">
            <div ng-repeat="sub_asset in modal_sub_assets">
                @{{sub_asset.sub_asset_class_name}}
            </div>
        </div>
    </div>
</div>
<!-- End modal -->