<div>
    <h2 class="page-title">Settings</h2>
</div>
<div>
    {{Form::open(array("url" => "admin/settings","method"=>"PUT","files" => true))}}
    @foreach($settings as $setting)
        <div class="form-group">
            <label>{{$setting->setting_name}}</label>&nbsp;&nbsp;&nbsp;
            @if($setting->type == 'radio')
                <input type="radio" value="1" name="setting_{{$setting->id}}" @if($setting->value == 1) checked @endif> YES &nbsp;&nbsp;&nbsp;
                <input type="radio" value="0" name="setting_{{$setting->id}}" @if($setting->value == 0) checked @endif> NO
            @endif

            @if($setting->type == 'file')
                <input type="file" name="setting_{{$setting->id}}">
                @if($setting->value != "") <a href="{{$setting->value}}" target="_blank">See current</a> @endif
            @endif

            @if($setting->type == 'text')
                <input type="text" class="form-control" name="setting_{{$setting->id}}" value="{{$setting->value}}"/>
            @endif
            <hr>
        </div>

    @endforeach

    <button type="submit" class="btn blue" style="margin-top: 10px;">Submit</button>
    {{Form::close()}}

</div>