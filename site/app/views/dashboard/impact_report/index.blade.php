@include('header')
@include('navigation')
@include('dashboard.side_nav')
<main class="ng-cloak product-page" ng-controller="investorImpactBetaCtrl">
	<div class="tooltipMap" ng-show="displayTooltip"></div>
	@include('dashboard.title_bar')
	<div class="container-fluid" style="padding-top: 30px; padding-bottom: 50px;">
		<div class="row">
			
			<div class="col-md-2">
				<div id="product-menu">
					<ul>
						<li >
							<a href="#overview" class="active">
							<img src="{{url('assets/product_page_icons/ready_for_review_icon.png')}}"> Overview
							</a>
						</li>
						<li>
							<a href="#impact">
							<img src="{{url('assets/product_page_icons/financials.png')}}"> Impact Assessment
							</a>
						</li>
						<li>
							<a href="#impact_footprint">
							<img src="{{url('assets/product_page_icons/icon-low-environmental-impact-300x300.jpeg')}}"> Impact Footprint
							</a>
						</li>
						
					</ul>
				</div>

			</div>
			<div class="col-md-10">
				@include('dashboard.impact_report.overview')
				@include('dashboard.impact_report.impact_assessment')
				@include('dashboard.impact_report.impact_footprint')
			</div>

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