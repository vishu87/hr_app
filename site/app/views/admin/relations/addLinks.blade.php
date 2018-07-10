<div ng-controller="relationCtrl" ng-init="relation_id={{$relation_id}};initials();addRelationLinks(relation_id);" class="ng-cloak">
	<div class="row ng-cloak" >
		<div class="col-md-9">
			<h3 class="page-title uppercase">@{{relationLinks.relation_name}} </h3>
		</div>
		<div class="col-md-3">
			<a href="{{url('/relations')}}" class="btn blue pull-right">Go Back</a>
		</div>
	</div>
	<form name="RelationLinksForm" ng-submit="submitRelationLinks(RelationLinksForm.$valid)" class="ng-cloak">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Tag</label>
                    <select ng-model="relationLinks.select_tag_id" class="form-control" ng-change="loadSelectSubtags()">
                        <option ng-repeat="tag in tags" ng-value="tag.id">@{{tag.tag_name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Relation Tag</label>
                    <select ng-model="relationLinks.link_tag_id" class="form-control" ng-change="loadRelationSubtags()">
                        <option ng-repeat="tag in tags" ng-value="tag.id">@{{tag.tag_name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" ng-if="relationLinks.selecttags.length > 0" ng-repeat="selecttag in relationLinks.selecttags">
            <div class="col-md-4 form-group" style="text-align:right">
                <span>@{{selecttag.subtag_name}}</span>
            </div>
            <div class="col-md-8 form-group">
                <select ng-model="selecttag.relation_tag_id" class="form-control">
                    <option ng-repeat="linktag in selecttag.linktags" ng-value="linktag.subtag_id">@{{linktag.subtag_name}}</option>
                </select>
            </div>
        </div>
        
        <div>
            <button type="submit" class="btn green" ladda="processing">Submit</button>
        </div>
    </form>
</div>