@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak product-page" ng-controller="ProductPageCtrl" ng-init="investment_id = {{$investment->id}}; initials(); ">
	@include('dashboard.title_bar')
	<div class="container-fluid" style="padding-top: 30px; padding-bottom: 50px;">
		<div class="row">
			
			<div class="col-md-2">
				<div id="product-menu">
					<ul>
						<li >
							<a href="#overview" class="active">
							<img src="{{url('assets/product_page_icons/ready_for_review_icon.png')}}"> Product Overview
							</a>
						</li>
						<li>
							<a href="#financial">
							<img src="{{url('assets/product_page_icons/financials.png')}}"> Financial Information
							</a>
						</li>
						<li>
							<a href="#impact">
							<img src="{{url('assets/product_page_icons/icon-low-environmental-impact-300x300.jpeg')}}"> Impact Information
							</a>
						</li>
						<li>
							<a href="#impact_areas">
							<img src="{{url('assets/product_page_icons/world-location_318-67930.jpg')}}"> Impact<br>Areas
							</a>
						</li>
					</ul>
				</div>

			</div>
			<div class="col-md-10">
				
				@include('dashboard.product_page.overview')
				@include('dashboard.product_page.financial')
				@include('dashboard.product_page.impact')
				@include('dashboard.product_page.impact_areas')

			</div>

		</div>
	    
    </div>

    <div class="product-footer">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-md-6">
    				<div>
    					<div class="policy-document small">
				 			<a href="{{url('product/create-pdf/'.$investment->id)}}" target="_blank">
				 				<i class="fa fa-file-pdf-o"></i> PDF
				 			</a>
				 		</div>
				 		<div class="policy-document small">
				 			<a href="{{url('assets/files/Product_DOC.docx')}}" target="_blank">
				 				<i class="fa fa-file-word-o" style="color:#2a5699"></i> DOC
				 			</a>
				 		</div>
    				</div>
    			</div>
    			<div class="col-md-6">
    				<div class="text-right" ng-if="!loading" style="margin-top: 5px">
						<button class="btn blue" ng-show="!investment.in_portfolio" ng-click="addPortfolioStart(investment)" ladda="open_investment.adding">Add to Portfolio</button>
						<button class="btn red" ng-show="investment.in_portfolio" ng-click="removeFromPortfolio(investment)" ladda="open_investment.adding">Remove from Portfolio</button>
					</div>
    			</div>
    		</div>
    	</div>
    </div>

    @include('dashboard.investor.amount_modal')


    <div id="irrModal" class="modal fade in modal-overflow" data-width="600" style="top:150px">
	    <div class="modal-body">
	        <h2 style="font-size: 24px">ANDORRA IRR<sup>TM</sup> Score</h2>
	        <p>
	        	Andorra's IRR<sup>TM</sup> Score measures the Impact, Return and Risk of an investment. The IRR Score is based on a 7 point scale from 3-9.
	        </p>
	        <p>
	        	<img src="{{url('assets/img/andorra_irr.jpg')}}" style="width:100%; height: auto">
	        </p>
	    </div>
	</div>
</main>

<script type="text/javascript">
$(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 100
        }, 500, 'swing', function () {
            // window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    console.log(scrollPos);
    $('#product-menu a').each(function () {

        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#product-menu ul li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}
</script>
@include('footer')