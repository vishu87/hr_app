<div class="modal-dialog modal-sm" role="document">
	<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="popup">
				<h3>Login to Andorra</h3>
				<p class="heading-text"></p>
				<div class="form-error ng-cloak" ng-show="formError != ''" class="ng-cloak">
					@{{formError}}
				</div>
				
				<form name="loginForm" class="loginForm" novalidate="novalidate" ng-submit="onSubmit(loginForm.$valid)" > 
					<div class="form-group">
						{{Form::text('username','',["required" => true,'placeholder'=>'Username', "ng-model" => "loginData.username", "class"=>"form-control"])}}
					</div>
					<div class="form-group">
						{{Form::password('password',["required" => true, "class"=>"form-control",'placeholder'=>'Password', "ng-model" => "loginData.password"])}}
					</div>
					<div class="row">
						<div class="col-xs-6">
							{{Form::checkbox('remember_me','',true,["style"=>"display: inline; width:auto; margin-bottom: 20px","ng-model" => "loginData.remember_me"])}}
							<span style="display: inline;"> Remember Me</span>
						</div>
						<div class="col-xs-6 forgot">
							<a href="{{url('/forgot-password')}}">Forgot your password?</a>
						</div>
					</div>
					<div class="">
						<button class="cherry-btn full" style="color:#FFF" type="submit" ladda="processing">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>