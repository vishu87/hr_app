@include('header')
	
	<div ng-controller="investmentSheetCtrl" ng-init="initials()" style="background:#FFF">
		<table class="table table-hover">
			<thead>
				<tr>
					<th ng-repeat="field in fields">@{{field.name}}</th>
				</tr>
				<tr>
					<th ng-repeat="field in fields" >
						<div style="position: relative;">
							<input type="text" ng-model="searchFilter[field.slug_text]" class="form-control">
							<a href="javascript:;" ng-show="searchFilter[field.slug_text] " ng-click="searchFilter[field.slug_text] = '' " style="position: absolute; right: 5px; top: 5px; color: #AAA;">
								<i class="fa fa-remove"></i>
							</a>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="investment in investments | filter : searchFilter" >
					<td ng-repeat="field in fields" ng-dblclick="dblClick(investment, field)">
						<div ng-show="!investment[field.slug+'_edit'].show">
							@{{investment[field.slug_text]}}
						</div>

						<div ng-show="investment[field.slug+'_edit'].show">
							<div ng-if="field.type == 'input' ">
								<input ng-model="investment[field.slug+'_edit'].value" ng-value="investment[field.slug_text]" type="text" class="form-control" ng-keyup="changeValue(investment, field, $event)" ng-disabled="investment[field.slug+'_edit'].processing" />
							</div>
							<div ng-if="field.type == 'select' ">
								<select ng-model="investment[field.slug]" ng-disabled="investment[field.slug+'_edit'].processing" ng-options="item.id as item.name for item in field.options" ng-selected="investment[field.slug]" class="form-control" ng-change="changeValue(investment, field, $event)"></select>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<div id="impactAreaModal" class="modal fade in modal-overflow" data-width="600">
		    <div class="modal-body">
		        @include('admin.entrepreneur.investments_sheet_area_modal')
		    </div>
		</div>

		<div id="impactSectorModal" class="modal fade in modal-overflow" data-width="600">
		    <div class="modal-body">
		        @include('admin.entrepreneur.investments_sheet_sector_modal')
		    </div>
		</div>

		<div id="impactGoalModal" class="modal fade in modal-overflow" data-width="600">
		    <div class="modal-body">
		        @include('admin.entrepreneur.investments_sheet_goal_modal')
		    </div>
		</div>

	</div>

@include('footer')