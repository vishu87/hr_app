<div>
	<h2 class="page-title">Upload Investment CSV</h2>
	@if(Session::has('failure'))
	<div class="alert alert-warning">
		{{Session::get('failure')}}
	</div>
	@endif
	{{Form::open(array("url"=>"/entrepreneur/upload","method"=>"POST","files" => true,"target"=>"_blank"))}}
		<div class="row" style="margin-top: 30px">
			<div class="col-md-6">
				<input type="file" name="csv_file">
			</div>
			<div class="col-md-3">
				{{Form::select("type",["1"=>"Check","2"=>"Entry"],"",["class"=>"form-control"])}}
			</div>
		</div>
		<div style="margin-top: 50px;">
			<button type="submit" class="btn blue">Upload</button>
		</div>
	{{Form::close()}}

</div>