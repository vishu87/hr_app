@include('header')
	<style type="text/css">
		.link-field {
			text-transform: uppercase;
			font-size: 11px;
		}
	</style>	
	<div ng-controller="investmentSheetCtrl" ng-init="initials('all')" style="background:#FFF; margin-bottom: 100px" class="ng-cloak">
		<div ng-if="loading" style="background: #FFF; padding: 20px; min-height: 700px; position: relative;">
			<div class="loading" ng-show="loading" style=""></div>
		</div>
		<div ng-if="!loading">
			<div class="sheet-table head" style="z-index:999">
				<div class="">
					<div style="position: relative;">
						<div ng-repeat="filter in data.filters" class="@{{filter.class}}">
							<div>

								<div ng-if="filter.type == 'input' ">
									<input ng-model="filter.value" class="form-control" />
								</div>

								<div ng-if="filter.type == 'select' || ( filter.type == 'multiple' && filter.slug == 'company_name') ">
									<select ng-model="filter.value" ng-options="item.id as item.name for item in filter.options" ng-click="fetchSubTags(filter)" class="form-control"></select>
									<span ng-if="filter.options.length == 0" ng-click="fetchSubTags(filter)">Add Filter</span>
									<span ng-show='filter.value' ng-click="filter.value = '' " style="font-size: 11px; cursor: pointer;">Remove</span>
								</div>

							</div>
						</div>
						<div style="position: fixed; width: 100px; right: 0; top: 5px; background: transparent; border: none" class="text-right">
							<button class="btn btn-xs blue" ng-click="initials('filter')" ladda="filtering" style="margin-bottom: 5px">Apply filter</button>
							<button class="btn btn-xs red" ng-click="clearAllFilters()" ladda="filtering">Clear all filters</button>
						</div>
					</div>
					<div>
						<div ng-repeat="field in fields" class="@{{field.class}}" ng-class="head_col == field.slug ? 'active' :'' ">
							<div>@{{field.name}}</div>
						</div>
					</div>
					<div>
						<div ng-repeat="field in fields" class="@{{field.class}}">
							<div style="position: relative;">
								<input type="text" ng-model="searchFilter[field.slug_text]" class="form-control">
								<a href="javascript:;" ng-show="searchFilter[field.slug_text] " ng-click="searchFilter[field.slug_text] = '' " style="position: absolute; right: 5px; top: 5px; color: #AAA;">
									<i class="fa fa-remove"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="sheet-table investments-dummy" style="z-index:998">
				<div>
					<div ng-repeat="investment in investments | filter : searchFilter">
						<div ng-repeat="field in fields" ng-if="$index == 0" ng-class="investment.id == hover_investment_id ? 'active' :'' ">
							<div>
								<a href="{{url('investments/edit/')}}/@{{investment.id}}" target="_blank">@{{investment[field.slug_text]}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="sheet-table investments">
				<div>
					<div ng-repeat="investment in investments | filter : searchFilter" >
						<div ng-repeat="field in fields" ng-dblclick="dblClick(investment, field)" class="@{{field.class}}" ng-mouseenter="hoverItem(field, investment.id)">
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
								<a class="link-field" href="javascript:;" ng-click="cancelClick(investment,field)">Cancel</a>
								<a class="link-field" href="javascript:;" style="margin-left: 10px" ng-click="changeToNull(investment, field)">Remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>

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

			<div id="companyModal" class="modal fade in modal-overflow" data-width="600">
			    <div class="modal-body">
			        @include('admin.entrepreneur.investments_company_modal')
			    </div>
			</div>

		</div>

		<div class="sheet-paging">
			<div class="row">
				<div class="col-md-10">
					<a href="javascript:;" class="paging" ng-click="changePage(page_no - 1)" ng-if="page_no != 1">Pre</a>

					<a href="javascript:;" class="paging" ng-click="changePage(n)" ng-repeat="n in range(1, total_pages)" ng-class="n == page_no ? 'active' : '' ">@{{n}}</a>

					<a href="javascript:;" class="paging" ng-click="changePage(page_no+1)" ng-if="page_no != total_pages">Next</a>

					<span ng-if="changing_page" style="font-weight: bold;">Processing</span>
				</div>
				<div class="col-md-2" style="text-align: right;">
					<span ng-if="!changing_page && !loading">
						Showing @{{50*(page_no-1) + 1}} to @{{ (50*page_no < total_investments) ? 50*page_no : total_investments }}
					</span>
				</div>
				<div>
					
				</div>
			</div>
		</div>

	</div>
	<script type="text/javascript">
		$(window).scroll(function(e){
			
			$(".head").css('margin-left', '-'+$(window).scrollLeft()+'px');
			$(".investments-dummy").css('margin-top', '-'+$(window).scrollTop()+'px');

			if($(window).scrollLeft() < 50){
				$(".investments-dummy").hide();
			} else {
				$(".investments-dummy").show();
			}
		});
	</script>
@include('footer')