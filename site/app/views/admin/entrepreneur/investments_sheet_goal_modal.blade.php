<div class="col-md-12">
	<div class="form-group">
		<h3 style="margin-bottom: 5px;" class="modal-title">U.N. Sustainable Development Goals</h3>

		<div class="row" ng-repeat="goal in formData.goals">
			<div class="col-md-1" style="text-align: center;">
				<h4>@{{$index + 1}}</h4>
			</div>
			<div class="col-md-4 form-group">
				<select ng-model="goal.goal_id" class="form-control" convert-to-number>
					<option ng-repeat="goal in development_goals" value="@{{goal.id}}">@{{goal.subtag_name}}</option>
				</select>
				<input ng-model="goal.goal_other" class="form-control other-text" ng-if="goal.goal_id == -1 " placeholder="Please enter value">
			</div>
			<div class="col-md-1" style="text-align: center;">
				<button class="btn btn-xs" type="button" ng-click="removeImpactGoal($index)" style="margin-left:5px"><i class="fa fa-remove"></i></button>
			</div>
		</div>
		<div>
			<button type="button" class="btn btn-xs" ng-click="addMoreImpactGoal()">Add More</button>
		</div>
		<hr>
		<button class="btn blue" ng-click="saveInvestment()" ladda="formData.processing">Save</button>
		<hr>
	</div>
</div>