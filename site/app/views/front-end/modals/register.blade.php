<div class="modal-dialog modal-sm" role="document">
	<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="popup">
				<h3>Investors</h3>
				<p class="heading-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
				<div class="form-error ng-cloak" ng-show="formError != ''" class="ng-cloak">
					@{{formError}}
				</div>
				<div class="form-success ng-cloak" ng-show="formSuccess != ''" class="ng-cloak">
					@{{formSuccess}}
				</div>
				<form name="registerForm" novalidate="novalidate" ng-submit="onSubmit(registerForm.$valid)" ng-show="true">
					<div class="row">
						<div class="col-md-6 input-div">
							<div class="form-group">
								{{Form::text('first_name','',["required" => "true", "class"=>"form-control", 'placeholder'=>'First Name', 'ng-model' => 'registerData.first_name'])}}
								<span class="red-asterik">{{$errors->first('first_name')}}</span>
							</div>
						</div>
						<div class="col-md-6 input-div">
							<div class="form-group">
								{{Form::text('last_name','',["required" => "true", "class"=>"form-control", 'placeholder'=>'Last Name', 'ng-model' => 'registerData.last_name'])}}
								<span class="red-asterik">{{$errors->first('last_name')}}</span>
							</div>
						</div>
					</div> 
					<div class="form-group">
						{{Form::text('username','',["required" => "true", "class"=>"form-control", 'placeholder'=>'Username', 'ng-model' => 'registerData.username'])}}
						<span class="red-asterik">{{$errors->first('username')}}</span>
					</div>
					<div class="form-group">
						{{Form::email('email','',["required" => "true", "class"=>"form-control",'placeholder'=>'Email Address', 'ng-model' => 'registerData.email'])}}
						<span class="red-asterik">{{$errors->first('email')}}</span>
					</div>
					<div class="form-group">
						{{Form::text('group_id','',["class"=>"form-control",'placeholder'=>'Group Id (Optional)', 'ng-model' => 'registerData.group_id'])}}
						<span class="red-asterik">{{$errors->first('email')}}</span>
					</div>
					<div class="form-group">
						{{Form::password('password',["required" => "true", "class"=>"form-control",'placeholder'=>'Password', 'ng-model' => 'registerData.password', 'ng-pattern'=>'/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[~!@#$%&_^*]).{8,}$/', 'ng-pattern-err-type'=>'patternPassword'])}}
						<span class="red-asterik">{{$errors->first('password')}}</span>
					</div>
					<div class="form-group">
						{{Form::password('re_password',["required" => "true", "class"=>"form-control",'placeholder'=>'Confirm Password', 'ng-model' => 'registerData.re_password'])}}
						<span class="red-asterik">{{$errors->first('password')}}</span>
					</div>
					<div class="algn-rght">
						<button class="submit-btn" type="submit" ladda="processing">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>