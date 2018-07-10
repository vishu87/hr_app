<div>
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                Questionnaires
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue">Add Questionnaire</button>
        </div>
    </div>

    <div class="ng-cloak">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;">SN</th>
                    <th>Name</th>
                    <th style="width: 180px"> # </th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                @foreach($questionnaires as $questionnaire)
                <tr >
                    <td>{{++$count}}</td>
                    <td> {{$questionnaire->name}} </td>
                    <td>
                        <a class="btn btn-primary uppercase " style="margin-top: 2px;" href="{{url('/questions/'.$questionnaire->id)}}">Edit</a>
                        <a class="btn green uppercase " style="margin-top: 2px;" href="{{url('/users/questionnaire/'.$questionnaire->id)}}" target="_blank">View</a>
                    </td>
                </tr>
                @endforeach
                    
            </tbody>
        </table>
    </div>

</div>