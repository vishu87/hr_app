<div class="container">
	<div class="profile-table">
		<?php $count = 0; ?>
		@foreach($profiles as $profile_item)
		<div class="profile-item">
			<div class="table">
				<div class="img">
					<img src="{{url('/assets/svg/'.$profile_item['icon'])}}">
				</div>
				<div>
					<span class="title">
						{{$profile_item["prefix"]." "}}<a href="javascript:;" class="tooltip-link {{(isset($glossary[$profile_item['glossary']])) ? ($glossary[$profile_item['glossary']] != '') ? 'has-remarks' : '' :''}}" tooltips tooltip-template="{{ (isset($glossary[$profile_item['glossary']])) ? $glossary[$profile_item['glossary']] : ''}}">{{$profile_item["term"]}}</a>
					</span>
					@if($count == 3)
						@{{profiles[3].value | currency}}
					@elseif($count == 6)
						@{{(profiles[6].value < 3.5) ? 'Low':''}}
						@{{(profiles[6].value > 3.5 && profiles[6].value < 7) ? 'Medium':''}}
						@{{(profiles[6].value > 7) ? 'High':''}}
					@elseif($count == 1)
						<div>
							<span ng-repeat="value in profiles[1].value">
								@{{$index > 0 ?' - ':''}} <a href="javascript:;" class="tooltip-link" tooltips tooltip-template="@{{value.remarks}}" ng-class="value.remarks ? 'has-remarks' : '' ">@{{value.subtag_name}}</a>
							</span>
						</div>	
					@else
						<div>
							<span ng-repeat="value in profiles[{{$count}}].value">
								@{{$index > 0 ?', ':''}} <a href="javascript:;" class="tooltip-link" tooltips tooltip-template="@{{value.remarks}}" ng-class="value.remarks ? 'has-remarks' : '' ">@{{value.subtag_name}}</a>
							</span>
						</div>	
					@endif
				</div>
			</div>
		</div>
		<?php $count++ ?>
		@endforeach

 		@if(Input::has("ref"))
 		<div class="btns-div">
 			<div style="margin-top: 20px;" ng-if="!hide_confirm" class="hidden">
				<a href="javascript:;" class="btn blue block" ng-click="confirmModal()">Does this look like you?</a>
			</div>
		
			<div style="margin-top: 20px;" class="row">
				<div class="col-md-6"><a href="{{url('/investor/home')}}" class="btn blue block">Go to Dashboard</a></div>
				<div class="col-md-6"><a href="{{url('/investor/strategy?ref=st')}}" class="btn green block">Check Out Strategy</a></div>
			</div>
 		</div>
 		@endif


	</div>
</div>

<div id="profileModal" class="modal fade in modal-overflow" data-width="500">
    <div class="modal-body">
        <h2>Does this profile look like you?</h2>
        <div class="row">
        	<div class="col-md-6">
        		<button type="button" ladda="processing" ng-click="confirm(1)" class="btn block green"><i class="fa fa-thumbs-up"></i> Yes</button>
        	</div>
        	<div class="col-md-6">
        		<button type="button" ladda="processing" ng-click="confirm(-1)" class="btn block red"><i class="fa fa-thumbs-down"></i> No</button>
        	</div>
        </div>
    </div>
</div>