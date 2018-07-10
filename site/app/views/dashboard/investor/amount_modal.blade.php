<div id="amountModal" class="modal fade in modal-overflow" data-width="600" style="top:150px">
    <div class="modal-body">
        <h2 style="font-size: 24px">How much money do you want to invest?</h2>
        <input name="amount" ng-model="investment_amount" id="investment_amount" type="text" class="form-control" placeholder="Enter Amount">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button ladda="adding" type="button" class="btn blue block" style="margin-top:10px;" ng-click="addPortfolio(open_investment)">Add Investment</button>
            </div>
            <div class="col-md-6 hidden">
                <button type="button" class="btn green block" style="margin-top:10px;">Invest</button>
            </div>
        </div>
    </div>
</div>