<div ng-controller="investmentCtrl" ng-init="entrepreneur_id={{$entrepreneur_id}};initials()" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Investments - {{$entrepreneur_name}}
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn default pull-right" href="{{url('/entrepreneur')}}">Go Back</a>
            <a class="btn blue pull-right" href="{{url('/investments/addInvestment/'.$entrepreneur_id)}}" target="_blank">Add Investment</a>

        </div>
    </div>
    
    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" datatable="ng">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th>Product Name</th>
                    <th>Asset Class</th>
                    <th>Sub Asset Class</th>
                    <th>Status</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="investment in investments">
                    <td> @{{$index+1}}</td>
                    <td> @{{investment.product_name}}</td>
                    <td> @{{investment.asset_class_name}}</td>
                    <td> @{{investment.sub_asset_class_name}}</td>
                    <td> @{{investment.status_name}}</td>
                    <td>
                        <a href="{{url('/investments/edit/')}}/@{{investment.id}}" class="btn btn-sm yellow uppercase">Edit</a>
                        
                        <button class="btn btn-sm red-mint" ng-click="delete(investment, $index)" ladda="investment.deleting"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>