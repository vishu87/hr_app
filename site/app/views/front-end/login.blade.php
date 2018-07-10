@include('front-end.header')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="text-align: center;">
            <div class="logo" style="margin: 80px 0 20px 0;">
                <img src="{{url('front-end/img/logo.png')}}">
            </div>
            @if(Session::has('failure'))
                <div style="margin-bottom: 20px; color: #F00">
                    {{Session::get('failure')}}
                </div>
            @endif
            {{Form::open(array("url" => "/home", "method" => "post"))}}
                <div class="form-group">
                    {{Form::text('username','',["class"=>"form-control","required"=>"true"])}}
                </div>
                <div class="form-group">
                    {{Form::password('password',["class"=>"form-control","required"=>"true"])}}
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Log In</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@include('front-end.footer')