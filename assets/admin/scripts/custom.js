$(document).on("click",".datepicker",function(){
	$(this).datepicker({
    	format:"dd-mm-yyyy"
    });
	$(this).datepicker("show");
});

$(document).on("keyup",".price_format",function(e){
	// e.preventDefault();
	console.log(e.keyCode);

	var val = $(this).val();
	var numeric = val.replace(/\D/g, '');

	if(numeric != '') {
		var val = $(this).val();
		var numeric = val.replace(/\D/g, '');
		console.log(numeric);
		// var formatted = numeric.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
		$(this).val(accounting.formatMoney(numeric, "$", 0));
	}
	
});

$(document).ready(function(e){
	$(".main-li").click(function(e){
		$(this).find("ul").slideToggle();
		$(this).toggleClass("open");
	});

	$(".main-li li").click(function(e){
		e.stopPropagation();
	});
});

function addPeriod(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function setSidebar(){
	var window_height = $(window).height();
	var body_height = $("body").height();
	console.log(window_height, body_height);
	var height = (window_height >= body_height) ? window_height : body_height;
	$(".home-sidebar").css("min-height",height+'px');
}

setSidebar();

$(window).resize(function(e){
	setSidebar();
});

$(".float-btn").click(function(e){
	$(this).hide();
	$(".side-nav .menu").animate(
		{ marginLeft: '-50px' },
		{
	        duration: 'fast',
	        easing: 'easeOutBack',
	        complete: function() {
	        }
	    }
	);
});

$(".side-nav .close-btn").click(function(e){
	$(".side-nav .menu").animate(
		{ marginLeft: '-300px' },
		{
	        duration: 'fast',
	        easing: 'easeOutBack',
	        complete: function() {
	        	$(".float-btn").show();
	        }
	    }
	);
});

$(".glossary-toggle").click(function(e){
	$(".glossary").toggle();
	$(this).toggleClass('active');
});

var gdpData = {
  "AF": 16.63,
  "AL": 11.58,
  "DZ": 158.97,
};
var map_data = {
  map: 'world_mill',
  backgroundColor: '#FFF',
  regionsSelectable : true,
  regionStyle: {
	  initial: {
	    fill: '#EEE',
	    "fill-opacity": 1,
	    stroke: 'none',
	    "stroke-width": 0,
	    "stroke-opacity": 1
	  },
	  hover: {
	    "fill-opacity": 0.8,
	    cursor: 'pointer'
	  },
	  selected: {
	    fill: '#15365d'
	  },
	  selectedHover: {
	  }
	},
	onRegionTipShow: function (e, label, code) {

	},
	onRegionSelected: function(e, code, isSelected, selectedRegions){

	},
	selectedRegions: ['RU']
};

$(document).on('mouseenter','.delete-btn',function(e){
	$(this).parent().addClass('active');
});
$(document).on('mouseleave','.delete-btn',function(e){
	$(this).parent().removeClass('active');
});

$(document).on('click','.delete-btn',function(e){
	$(this).parent().remove();
});
$(document).on('mouseenter','.add-section',function(e){
	$(this).parent().parent().addClass('active');
});
$(document).on('mouseleave','.add-section',function(e){
	$(this).parent().parent().removeClass('active');
});

function eConsole(param) {
 	if (typeof param.seriesIndex != 'undefined') {
 		var div = $("#"+param.seriesId+" .chart-details");
 		div.find(".item").eq(param.dataIndex).addClass("active");
  	}
}

function eConsoleOut(param) {
 	$(document).find(".chart-details .item").removeClass("active");
}