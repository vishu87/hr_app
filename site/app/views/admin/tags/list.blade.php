<div ng-controller="tagCtrl" ng-init="menu_id={{$menu_id}}; initials();" class="ng-cloak">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title" style="margin-top: 0">
                {{$title}}
            </h1>
        </div>
        <div class="col-md-4">
            <button class="btn pull-right blue" ng-click="addTag()">Add Tag</button>
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th> Tag ID </th>
                    <th> Tag </th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="tag in tags">
                    <td> @{{$index+1}}</td>
                    <td> @{{tag.id}}</td>
                    <td> @{{tag.tag_name}} </td>
                    <td>
                        <button class="btn yellow uppercase" ng-click="editTag(tag.id)">Edit</button>
                        <button class="btn blue uppercase" ng-click="addSubTag(tag.id,tag.tag_name)">Sub Tags</button>
                        <button class="btn red-mint uppercase" ng-click="deleteTag(tag.id,$index)" ladda="processing_@{{$index}}"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Begin  Modal -->
    <div id="tags" class="modal bs-modal-sm fade in modal-overflow" style="top: 150px !important;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">@{{(tag_id != 0)?'Update':'Add'}} Tag</h4>
        </div>
        <div class="modal-body" >
            <form name="TagForm" ng-submit="onSubmit(TagForm.$valid)">
                <div class="form-group">
                    <input type="text" ng-model="tagData.tag_name" class="form-control" placeholder="Tag Name" required >
                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">@{{(tag_id != 0)?'Update':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>

    <div id="subtags" class="modal bs-modal-sm fade in modal-overflow" data-width="70%">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add Subtags</h4>
        </div>
        <div class="modal-body" style="max-height: 500px;">
            <form name="subTagForm" ng-submit="storeSubTags(subTagForm.$valid)">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" ng-model="subTagData.subtag_name" class="form-control" placeholder="Subtag" required >
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" ng-model="subTagData.min" class="form-control" placeholder="Minimum Value">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" ng-model="subTagData.max" class="form-control" placeholder="Maximum Value">
                        </div>
                    </div>
                
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" ng-model="subTagData.color" class="form-control" placeholder="Select Color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button ng-show="subTagData.image == '' || subTagData.image == null" class="button btn upload-btn" ngf-select="uploadFile($file,'image',subTagData)" ngf-max-size="5MB" ladda="subTagData.uploading" data-style="expand-right" >Select Image</button>

                            <a class="btn blue ng-cloak" href="{{url('/')}}/@{{subTagData.image}}" ng-show="subTagData.image && subTagData.image != '' " target="_blank">View</a>

                            <a class="btn red ng-cloak" ng-click="removeFile(subTagData)" ng-show="subTagData.image && subTagData.image != '' "><i class="fa fa-remove"></i></a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <trix-editor ng-model="subTagData.remarks" angular-trix></trix-editor><!-- 
                            <input type="text" ng-model="" class="form-control" placeholder="Remarks"> -->
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn green" ladda="processing">Add</button>
                </div>
            </form>
        
            <h3 class="page-title" style="margin-top: 15px;">@{{tag_name}}</h3>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
                <thead>
                    <tr>
                        <th style="width: 50px;"> SN</th>
                        <th>Sub Tag ID</th>
                        <th>Sub Tag </th>
                        <th>Min </th>
                        <th>Max </th>
                        <th>Color </th>
                        <th>Remarks </th>
                        <th>Image </th>
                        <th> # </th>
                    </tr>
                </thead>
                <tbody ng-repeat="subtag in subtags">
                    
                    <tr>
                        <td> @{{$index+1}}</td>
                        <td>@{{subtag.id}}</td>
                        <td>
                            <span ng-if="!subtag.edit">
                                @{{subtag.subtag_name}}
                            </span>
                            <input ng-if="subtag.edit" type="text" ng-model="subtag.subtag_name" class="form-control" >
                        </td>
                        <td>
                            <span ng-if="!subtag.edit">
                                @{{subtag.min}}
                            </span>
                            <input ng-if="subtag.edit" type="text" ng-model="subtag.min" class="form-control" >
                        </td>
                        <td>
                            <span ng-if="!subtag.edit">
                                @{{subtag.max}}
                            </span>
                            <input ng-if="subtag.edit" type="text" ng-model="subtag.max" class="form-control" >
                        </td>

                        <td>
                            <span ng-if="!subtag.edit">
                                @{{subtag.color}}
                            </span>
                            <input ng-if="subtag.edit" type="text" ng-model="subtag.color" class="form-control" >
                        </td>
                        <td>
                            <span ng-if="!subtag.edit" ng-bind-html="subtag.remarks">
                            </span>
                            
                        </td>
                        <td>
                            <button ng-show="subtag.edit && (subtag.image == '' || subtag.image == null)" class="button btn upload-btn" ngf-select="uploadFile($file,'image',subtag)" ngf-max-size="5MB" ladda="subtag.uploading" data-style="expand-right" >Select Image</button>

                            <a class="btn blue ng-cloak" href="{{url('/')}}/@{{subtag.image}}" ng-show="subtag.image && subtag.image != '' " target="_blank">View</a>

                            <a class="btn red ng-cloak" ng-click="removeFile(subtag)" ng-show="subtag.image && subtag.image != '' && subtag.edit"><i class="fa fa-remove"></i></a>
                        </td>


                        <td>
                            <button ng-if="!subtag.edit" class="btn yellow uppercase" ng-click="subtag.edit=true"><i class="fa fa-edit"></i></button>

                            <button ng-if="subtag.edit" class="btn yellow uppercase" ng-click="updateSubtag(subtag)" ladda="subtag.processing">Save</button>
                            
                            <button class="btn red-mint uppercase" ng-click="deleteSubTag(subtag.id,$index)" ladda="processing_sub_@{{$index}}"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                    <tr ng-if="subtag.edit">
                        <td colspan="8" style="text-align:left">
                            <label>Remarks</label>
                            <trix-editor ng-model="subtag.remarks" angular-trix></trix-editor>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End modal -->
       
</div>