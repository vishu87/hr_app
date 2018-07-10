<div class="table title-bar box-shadow">
	<div @if(Input::has("ref")) class="normal float-btn" @endif>
		@if(!Input::has("ref"))
		<div class="float-btn">
			<i class="fa fa-bars"></i>
		</div>
		@endif
	</div>
	<div class="user-info">
		<div class="table">
			@if(isset($icon))
			<div class="img">
				<img src="{{url($icon)}}" class="svg-icon">
			</div>
			@endif
			<div>
				<div class="name">{{(isset($title))?$title:''}} @if(isset($glossary_id))<span class="glossary-toggle"><i class="fa fa-question-circle"></i></span> @endif</div>
				<div>{{(isset($sub_title))?$sub_title:''}}</div>
			</div>
		</div>
		@if(isset($glossary))
			@if(isset($glossary[$glossary_id]))
			<div class="glossary" style="display: none">
				{{$glossary[$glossary_id]}}
			</div>
			@endif
		@endif
	</div>
	<div>
	<?php if(isset($more_ques)) : ?>
		<a href="{{url('investor/questionnaire/1')}}" style="width: 300px; margin-left: 30px; display: block;">Answer more questions for<br>better investment recommendations</a>
	<?php endif; ?>

	<?php if(isset($show_list)) : ?>
		<div class="map-switch">
			<a href="#" ng-click="changeView(false)" ng-class="!map_view ? 'active' : '' "><i class="fa fa-list"></i> List</a> | <a href="#" ng-click="changeView(true)" ng-class="map_view ? 'active' : '' "><i class="fa fa-globe"></i> Map</a>
		</div>
	<?php endif; ?>

	<?php if(isset($investment_buttons)) : ?>
		<div class="text-right" ng-if="!loading">
			<button class="btn blue" ng-show="!investment.in_portfolio" ng-click="addPortfolioStart(investment)" ladda="open_investment.adding">Add to Portfolio</button>
			<button class="btn red" ng-show="investment.in_portfolio" ng-click="removeFromPortfolio(investment)" ladda="open_investment.adding">Remove from Portfolio</button>
		</div>
	<?php endif; ?>

	</div>
</div>