<div>
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Jobs
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue">Add job</button>
        </div>
    </div>

    <div class="ng-cloak">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;">SN</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th style="width: 180px"> # </th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                @foreach($jobs as $job)
                <tr >
                    <td>{{++$count}}</td>
                    <td> {{$job->title}} </td>
                    <td> {{$job->location}} </td>
                    <td>
                        <a class="btn btn-primary uppercase " style="margin-top: 2px;" href="{{url('/questions/'.$job->id)}}">Edit</a>
                        <a class="btn green uppercase " style="margin-top: 2px;" href="{{url('/users/job/'.$job->id)}}" target="_blank">View Applicants</a>
                    </td>
                </tr>
                @endforeach
                    
            </tbody>
        </table>
    </div>

</div>