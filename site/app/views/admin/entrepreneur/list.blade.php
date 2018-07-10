<div ng-controller="entrepreneurCtrl" ng-init="initials()" class="ng-cloak">
    <div class="row">
        <div class="col-md-3">
            <h1 class="page-title" style="margin-top: 0">
                Entrepreneurs
            </h1>
        </div>
        <div class="col-md-9">
            <a class="btn blue pull-right" href="{{url('/entrepreneur/add')}}" >Add Entrepreneur</a>
            <a class="btn green pull-right" href="{{url('/entrepreneur/view')}}" target="_blank" >View Sheet</a>
            <a class="btn yellow pull-right" href="{{url('/entrepreneur/upload')}}" >Upload Investments</a>
        </div>
    </div>
    
    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" datatable="ng">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th style="width: 50px;"> ID</th>
                    <th>Company Name</th>
                    <th>Status</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="entrepreneur in entrepreneurs">
                    <td> @{{$index+1}}</td>
                    <td> @{{entrepreneur.id}}</td>
                    <td> @{{entrepreneur.company_name}}</td>
                    <td> @{{entrepreneur.status_name}}</td>
                    <td>
                        <a href="{{url('/entrepreneur/edit/')}}/@{{entrepreneur.id}}" class="btn btn-sm yellow uppercase">Profile</a>
                        
                        <a href="{{url('/entrepreneur/investments/')}}/@{{entrepreneur.id}}" class="btn btn-sm green uppercase">Investments</a>
                        <button class="btn btn-sm red-mint" ng-click="delete(entrepreneur, $index)" ladda="entrepreneur.deleting"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>