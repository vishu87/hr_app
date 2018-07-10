<div ng-controller="strategyCtrl" ng-init="" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Asset Allocation
            </h1>
        </div>
        <div class="col-md-4">
            
        </div>
    </div>
<style type="text/css">
    .risk-score td input {
        width: 50px;
    }
    .risk-score td input:read-only {
        background : transparent;
        border: none;
    }
</style>
    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column risk-score">
            <thead>
                <tr>
                    <th>Time Horizon</th>
                    <th>Financial Return</th>
                    <th>Risk Profile</th>
                    @foreach($asset_classes as $asset_class_id => $asset_class_value)
                        <th>{{$asset_class_value}}</th>
                    @endforeach
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                    @foreach($time_horizons as $time_horizon_id => $time_horizon_value)
                        <?php $count1 = 0; ?>

                            @foreach($financial_returns as $financial_return_id => $financial_return_value)
                                <?php $count2 = 0; ?>

                                @foreach($risk_profiles as $risk_profile_id => $risk_profile_value)
                                    <tr class="rs_{{$time_horizon_id}}_{{$financial_return_id}}_{{$risk_profile_id}}">
                                        <form>
                                        @if($count1 == 0)<td rowspan="{{sizeof($financial_returns)*sizeof($risk_profiles)}}">{{$time_horizon_value}}</td>@endif
                                        @if($count2 == 0)<td rowspan="{{sizeof($risk_profiles)}}">{{$financial_return_value}}</td>@endif
                                        <td>{{$risk_profile_value}}</td>
                                        @foreach($asset_classes as $asset_class_id => $asset_class_value)
                                            <td>
                                                <?php $value = ''; ?>
                                                @if(isset($allocations[$time_horizon_id][$financial_return_id][$risk_profile_id][$asset_class_id]))
                                                    <?php $value = $allocations[$time_horizon_id][$financial_return_id][$risk_profile_id][$asset_class_id] ?>
                                                @endif
                                                <input name="score_{{$asset_class_id}}" type="text" value="{{$value}}" readonly />
                                            </td>
                                        @endforeach
                                        <td>
                                            <button class="btn edit" ng-click="edit({{$time_horizon_id}},{{$financial_return_id}},{{$risk_profile_id}})">Edit</button>
                                            <button class="btn update" ng-click="update({{$time_horizon_id}},{{$financial_return_id}},{{$risk_profile_id}})" style="display: none">Update</button>
                                        </td>
                                        </form>
                                    </tr>
                                    <?php $count1++; ?>
                                    <?php $count2++; ?>
                                @endforeach
                            @endforeach
                    @endforeach
            </tbody>
        </table>
    </div>
       
</div>