<!-- Begin  Modal -->
<div id="feebackModal" class="modal bs-modal-sm fade in modal-overflow" data-width="790">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Do you have any feedback for this question?</h4>
    </div>
    <div class="modal-body" >
        <form name="feedbackForm" ng-submit="onSubmitFeedback(feedbackForm.$valid)">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Choose a subject<span class="error"> *</span></label>
                        <select ng-model="feedbackData.subject" class="form-control" required >
                            <option>The question could be improved</option>
                            <option>The answer options are wrong or incomplete</option>
                            <option>The question is not important or relevant</option>
                            <option>The question is confusing</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" style="margin-top: 10px;">
                        <label>How can we make this question better?</label>
                        <textarea ng-model="feedbackData.feedback" class="form-control" required="true"></textarea>
                    </div>
                </div>

            </div>
            <div>
                <button type="submit" class="btn green" ladda="processing_feedback">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- End modal -->