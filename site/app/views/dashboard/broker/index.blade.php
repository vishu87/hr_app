<div class="row">
    <div class="col-md-9">
        <div style="height: 20px"></div>

        <h2>List of Clients</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Type of Investor</th>
                    <th>Portfolio Size</th>
                    <th>Portfolio Objective</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="client in clients">
                    <td>@{{client.client_id}}</td>
                    <td>@{{client.first_name + ' ' + client.last_name}}</td>
                    <td>@{{client.type}}</td>
                    <td>@{{client.size | currency}}</td>
                    <td>@{{client.portfolio_objective}}</td>
                    <td>
                        <a href="{{url('/loginAsInvestor')}}/@{{client.id}}" class="btn blue btn-sm">Login <i class="fa fa-angle-double-right"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="col-md-3">
        <div class="home-sidebar">
            <div class="trending">
                @include('dashboard.trending')
            </div>
            <hr>
            <div style="text-align:center">
                New to Impact Investment? <br> <a href="{{url('/history')}}">Learn More</a>
            </div>
        </div>
    </div>
</div>