<div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Database Source</label>
				<select ng-model="andorra.database_source" class="form-control" convert-to-number>
					<option ng-repeat="database in andorra_dropdowns.database_sources" value="@{{database.id}}">@{{database.subtag_name}}</option>
				</select>
				<input ng-model="andorra.database_source_other" class="form-control other-text" ng-if="andorra.database_source == -1 " placeholder="Please enter value">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Status</label>
				<select ng-model="formData.status" class="form-control" convert-to-number>
					<option ng-repeat="stat in andorra_dropdowns.status" value="@{{stat.id}}">@{{stat.name}}</option>
				</select>
			</div>
		</div>

		
	</div>

	<hr>
	<h4 class="modal-title">Auto Update fields</h4>
	<hr>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Employees</label>
				<select ng-model="formData.employee_tag_id" convert-to-number ng-disabled="true" class="form-control">
					<option ng-repeat="employee in employees" value="@{{employee.id}}">@{{employee.subtag_name}}</option>
				</select>
			</div>
		</div>
		
	</div>
</div>