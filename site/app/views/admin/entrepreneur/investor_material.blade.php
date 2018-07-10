<div>
    <div class="row">
        <div class="col-md-4 form-group">
            <label>Document Type</label>
            <select class="form-control" ng-model="tempDocument.document_id" convert-to-number>
                <option>Select</option>
                <option ng-repeat="document in documents" value="@{{document.id}}">@{{document.document}}</option>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <div style="margin-top: 23px">
                
                <button type="button" ng-show="tempDocument.document == '' || tempDocument.document == null" class="button btn upload-btn" ngf-select="uploadInvestorFile($file,'document',tempDocument)" ngf-max-size="5MB" ladda="tempDocument.uploading" data-style="expand-right" >Select Document</button>

                <a class="btn blue ng-cloak" href="{{url('/')}}/@{{tempDocument.document}}" ng-show=" tempDocument.document != null && tempDocument.document != ''  " target="_blank">View</a>

                <a class="btn red ng-cloak" ng-click="removeInvestorFile(tempDocument,'document')" ng-show=" tempDocument.document != null && tempDocument.document != ''  "><i class="fa fa-remove"></i></a>
            </div>
        </div>
        <div class="col-md-2">
            <button style="margin-top: 23px;" type="button" ladda="tempDocument.adding" class="btn btn-sm blue" ng-click="addDocument()" >Add</button>
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" datatable="ng">
            <thead>
                <tr>
                    <th style="width: 50px;"> SN</th>
                    <th>Document Type</th>
                    <th>Document</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
                
                <tr ng-repeat="document in formData.documents">
                    <td> @{{$index+1}}</td>
                    <td> @{{document.document_name}}</td>
                    <td>
                        <a ng-show="document.document != ''" href="{{url('/')}}/@{{document.document}}" target="_blank">View</a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm red-mint" ng-click="deleteDocument(document, $index)" ladda="document.deleting"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>