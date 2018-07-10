<div>
	<div class="row ng-cloak">
		<div class="col-md-8">
			<h1 class="page-title">
				{{ (isset($entrepreneur_id)) ? 'Update':'Add'}} Entrepreneur Profile
			</h1>
		</div>
		<div class="col-md-4">
			<a class="btn default pull-right" href="{{url('/entrepreneur')}}">Go Back</a>
		</div>
	</div>
	<div>
		@include('admin.entrepreneur.form')
	</div>
</div>