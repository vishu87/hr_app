app.controller('resultCtrl',function($scope , $http, $interval, UserResultService, FinancialReportService, RecommendationService, PortfolioService, $timeout){

	$scope.profiles = [];
	$scope.risk_score = 0;
	$scope.tab_id = 1;

    $scope.markers = [];
	// var infoWindow = new google.maps.InfoWindow();

	$scope.applied_filters = [];
	$scope.applied_filters_names = [];

	$scope.open_investment = {};
	$scope.show_investement = false;

	$scope.portfolios = [];

	$scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

    $scope.colors_map = ['0-10%','11-20%','21-30%','31-40%','41-50%','51-60%','61-70%','71-80%','81-90%','91-100%'];

    $scope.selectFilter = function(filter){
        console.log(filter.name);
    }

    $scope.myConfig = {
        onChange: function(value){
            console.log(value);
        },
        maxItems: 1,
    }

    $scope.regionHover = function(value){
        $scope.displayTooltip = true;
    }

    $scope.regionLeave = function(value){
        $scope.displayTooltip = false;
    }

	$scope.changeTab = function(tab_id) {
		$scope.tab_id = tab_id;

		if(tab_id == 3){
			$scope.showm();
			console.log('map');
			$scope.center = new google.maps.LatLng(0,0);
            $scope.map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 2,
                  center: $scope.center,
                  mapTypeId: google.maps.MapTypeId.TERRAIN,
                  styles: map_styles
              });
            $scope.setMarkers();
		}
	}

	$scope.showm = function(){

		$("#map").css('height','480px');

        $("#map").animate({
            height : "500px",
        },200,function(){
            google.maps.event.trigger($scope.map,"resize");
            $scope.map.setCenter($scope.center);
        });
    }

	$scope.initials = function(){
		UserResultService.initials().then(function(data){

			$scope.profiles = data.profile;
			$scope.risk_score = data.risk_score;

			$scope.major_asset_class_allocation = [];
            $scope.major_asset_colors = [];

			for (var i = data.major_asset_class_allocation.length - 1; i >= 0; i--) {
				$scope.major_asset_class_allocation.push({
					value : data.major_asset_class_allocation[i].allocation,
					name : data.major_asset_class_allocation[i].major_asset_class,
				});
                $scope.major_asset_colors.push(data.major_asset_class_allocation[i].color);
			}

            $scope.asset_class_allocation = [];
			$scope.asset_class_colors = [];

            $scope.sub_asset_class_allocation = [];
            $scope.sub_asset_colors = [];

			for (var i = data.asset_class_allocation.length - 1; i >= 0; i--) {
				$scope.asset_class_allocation.push({
					value : data.asset_class_allocation[i].allocation,
					name : data.asset_class_allocation[i].asset_class,
				});
                $scope.asset_class_colors.push(data.asset_class_allocation[i].color);

                if(data.asset_class_allocation[i].sub_asset_allocation.length > 0){
                    for (var j = 0; j < data.asset_class_allocation[i].sub_asset_allocation.length; j++) {
                        $scope.sub_asset_class_allocation.push({
                            value : data.asset_class_allocation[i].sub_asset_allocation[j].allocation,
                            name : data.asset_class_allocation[i].sub_asset_allocation[j].sub_asset_class,
                        });
                        $scope.sub_asset_colors.push(data.asset_class_allocation[i].sub_asset_allocation[j].color);
                    }
                } else {
                    $scope.sub_asset_class_allocation.push({
                        value : data.asset_class_allocation[i].allocation,
                        name : data.asset_class_allocation[i].asset_class,
                    });
                    $scope.sub_asset_colors.push(data.asset_class_allocation[i].color);

                }
			}

            // for (var i = data.asset_class_allocation.length - 1; i >= 0; i--) {
            //     $scope.sub_asset_class_allocation.push({
            //         value : data.sub_asset_class_allocation[i].allocation,
            //         name : data.sub_asset_class_allocation[i].sub_asset_class,
            //     });
            //     $scope.sub_asset_colors.push(data.sub_asset_class_allocation[i].color);
            // }

            $scope.sector_allocation = [];
			$scope.sector_colors = [];
            $scope.industry_allocation = [];
            $scope.industry_colors = [];

			for (var i = data.sector_allocation.length - 1; i >= 0; i--) {
				$scope.sector_allocation.push({
					value : data.sector_allocation[i].allocation,
					name : data.sector_allocation[i].sector,
				});
                $scope.sector_colors.push(data.sector_allocation[i].color);

                if(data.sector_allocation[i].industry_allocation.length > 0){
                    for (var j = data.sector_allocation[i].industry_allocation.length - 1; j >= 0; j--) {
                        $scope.industry_allocation.push({
                            value : data.sector_allocation[i].industry_allocation[j].allocation,
                            name : data.sector_allocation[i].industry_allocation[j].industry.subtag_name,
                        });
                        $scope.industry_colors.push(data.sector_allocation[i].industry_allocation[j].industry.color);

                    }
                } else {
                    $scope.industry_allocation.push({
                        value : data.industry_allocation[i].allocation,
                        name : data.industry_allocation[i].sector,
                    });
                    $scope.industry_colors.push(data.sector_allocation[i].color);                    
                }

			}

            

			// for (var i = data.industry_allocation.length - 1; i >= 0; i--) {

   //              if(data.industry_allocation[i].industry_allocation.length > 0){
   //  				for (var j = data.industry_allocation[i].industry_allocation.length - 1; j >= 0; j--) {
   //  					$scope.industry_allocation.push({
   //  						value : data.industry_allocation[i].industry_allocation[j].allocation,
   //  						name : data.industry_allocation[i].industry_allocation[j].industry.subtag_name,
   //  					});
   //                      $scope.industry_colors.push(data.industry_allocation[i].industry_allocation[j].industry.color);

   //  				}
   //              } else {
   //                  $scope.industry_allocation.push({
   //                      value : data.industry_allocation[i].allocation,
   //                      name : data.industry_allocation[i].sector,
   //                  });
   //                  $scope.industry_colors.push(data.industry_allocation[i].color);                    
   //              }
			// }
   //          console.log($scope.industry_allocation);

			$scope.un_goals_allocation = [];
            $scope.un_goals_colors = [];

			for (var i = data.un_goals_allocation.length - 1; i >= 0; i--) {
				$scope.un_goals_allocation.push({
					value : data.un_goals_allocation[i].allocation,
					name : data.un_goals_allocation[i].goal,
				});
                $scope.un_goals_colors.push(data.un_goals_allocation[i].color);
			}

			$scope.filter_types = data.filter_types;

			for (var i = $scope.filter_types.length - 1; i >= 0; i--) {
				for (var j = $scope.filter_types[i].filters.length - 1; j >= 0; j--) {
					$scope.applied_filters.push({
						type : $scope.filter_types[i].filters[j].type,
						values : []
					})
				};
			};

			$scope.investments = data.investments;

            $scope.international_allocation_perc = data.geographic.us_vs_international.international;
            $scope.us_allocation_perc = data.geographic.us_vs_international.us;

            $scope.geo_allocation = data.geographic.geo_allocation;
            $scope.us_allocation = data.geographic.us_allocation;

		});

		FinancialReportService.initials().then(function(data){
			$scope.financial_report = data.financial_report;
      
            $scope.overall_portfolio_return = data.financial_report.overall_portfolio_return;

            $scope.major_asset_class_target = data.financial_report.major_asset_class_target;
            	
            $scope.major_asset_class_current = data.financial_report.major_asset_class_current;

            $scope.major_assets = data.financial_report.major_assets;

            $scope.impact = data.impact;

            $scope.impact_sectors_current = data.impact.impact_sectors_current;
            $scope.impact_sectors_target = data.impact.impact_sectors_target;

            $scope.sdg = data.sdg;

            $scope.goals_current = data.sdg.goals_current;
            $scope.goals_target = data.sdg.goals_target;

            $scope.geo_preference = data.geo_preference;
            $scope.areas_current = data.geo_preference.areas_current;
            $scope.areas_target = data.geo_preference.areas_target;

		});

        RecommendationService.initials().then(function(data){

          $scope.reco_filters = data.filters;
          $scope.reco_investments = data.investments;

          for (var i = 0; i < $scope.reco_filters.length; i++) {
            var investments = [];

            for (var j = 0; j < $scope.reco_investments.length; j++) {
              var flag = false;

              if($scope.reco_filters[i].field == 'multiple'){
                
                if($scope.reco_investments[j][$scope.reco_filters[i].match_field].indexOf($scope.reco_filters[i].value) != -1 ){
                  flag = true;
                }

              } else {
                if($scope.reco_investments[j][$scope.reco_filters[i].match_field] == $scope.reco_filters[i].value){
                  flag = true;
                }
              }

              if(flag) investments.push($scope.reco_investments[j]);
            }
            
            $scope.reco_filters[i].investments = investments;

          }

          // console.log($scope.reco_filters);

        });

        PortfolioService.initials('major_asset_class').then(function(data){
            $scope.setPortfolio(data, 1);
            $scope.portfolios = data.cart_investments;
        });

	}

    $scope.setPortfolio = function(data, type){
        console.log(data,type);
        if(type == 1) {
            $scope.portfolio_sorters = data.sorters;
            $scope.grouper = data.sorter;
        }
        
        $scope.portfolio_investments = data.investments;
        $scope.portfolio_sorter_field = data.sorter;
        $scope.portfolio_groups = data.groups;
        $scope.include_cart = true;

        for (var i = $scope.portfolio_groups.length - 1; i >= 0; i--) {
            var count = 0;
            for (var j = $scope.portfolio_investments.length - 1; j >= 0; j--) {
                if($scope.portfolio_investments[j][$scope.portfolio_sorter_field] == $scope.portfolio_groups[i].id){
                    count++;
                }
            };
            if(count != 0) $scope.portfolio_groups[i].show = true;
        };
    }

    $scope.portfolioGroup = function(){
        PortfolioService.initials($scope.grouper).then(function(data){
            $scope.setPortfolio(data, 0);
        });
    }

	$scope.setMarkers = function (){
        for (i = 0; i < $scope.investments.length; i++){
            createMarker($scope.investments[i]);
        }
    }

    var createMarker = function (info){
        var color_index = Math.floor(Math.random() * 10);
        var circle = {
          path: google.maps.SymbolPath.CIRCLE,
          fillColor: info.color,
          fillOpacity: .9,
          scale: 5,
          strokeColor: 'white',
          strokeWeight: 1
      };
    	// console.log(info);
        if(info.latitude != 0 || info.longitude != 0){
            var marker = new google.maps.Marker({
                map: $scope.map,
                position: new google.maps.LatLng(info.latitude, info.longitude),
                title: info.product_name,
                icon: circle
            });
            // marker.content = '<div class="infoWindowContent" style="text-align:center"><span style="font-size:16px; font-weight:bold; max-width: 250px; display: block; text-align: center;">' + info.name + '</span></div> <div style="text-align:center">';
            // if(info.photo1 != '') marker.content += '<img src="'+ info.photo1 +'" style="margin-top:10px; height:100px; width:auto">';
            // marker.content += '</div><div style="text-align:center; margin-top:8px">Technology: <b>'+ info.technology_name+'</b><br>';
            
            // if(info.installed_capacity){
            //     marker.content += 'Installed Capacity: <b>'+info.installed_capacity+'MW</b><br>';
            // }

            // marker.content += '<a href="'+base_url+'/project/'+info.id+'" style="color:#00AF50" target="_blank">View Project</a></div>';
            
            google.maps.event.addListener(marker, 'click', function(){
                $scope.investmentDetails(info.id, info.product_name);
            });
            
            $scope.markers.push(marker);
        }
    }

    $scope.investmentDetails = function(id, product_name){
    	
        $scope.show_investement = true;
    	
        $scope.open_investment = {
            product_name : product_name
        };
    	$scope.processing = true;
        
        UserResultService.investmentDetails(id).then(function(data){
            console.log(data);
            $scope.open_investment = data.investment;
            $scope.processing = false;
		});
    }


    $scope.addFilter = function(type, id, name, filter){
      if(id == 0){
        filter.showdrop = false;
        return;
      }
    	
      if(filter){
    		filter.search = '';
    	}
    	
    	for (var i = $scope.applied_filters.length - 1; i >= 0; i--) {
    		if($scope.applied_filters[i].type == type){
    			var idx = $scope.applied_filters[i].values.indexOf(id);
    			if(idx > -1){
    				$scope.applied_filters[i].values.splice(idx,1);
    			} else {
    				$scope.applied_filters[i].values.push(id);
    			}
    		}
    	};
    	
    	var flag = false;
    	for (var i = $scope.applied_filters_names.length - 1; i >= 0; i--) {
    		if($scope.applied_filters_names[i].type == type && $scope.applied_filters_names[i].id == id){
    			$scope.applied_filters_names.splice(i,1);
    			flag = true;
    		}
    	};
    	if(!flag){
			$scope.applied_filters_names.push({
				id : id,
				type : type,
				name : name
			})
    	}

    	$scope.get_filter();
        console.log("#filter_"+type);
       $("#filter_"+type).find('input').focus();

    }

    $scope.get_filter = function(){
        var data = $scope.applied_filters;

        $http({
            method : "POST",
            url : base_url + '/investor/filter/map',
            data : data,
        }).then(function(response) {
            if(response.status == 200){
                console.log(response.data);
                $scope.investments = response.data.investments;
                
                // $scope.map = new google.maps.Map(document.getElementById('map'), {
                //     zoom: 2,
                //     center: $scope.center,
                //     mapTypeId: google.maps.MapTypeId.TERRAIN,
                //     styles: map_styles
                // });
                for (var i = 0; i < $scope.markers.length; i++ ) {
                  $scope.markers[i].setMap(null);
                }
                $scope.markers = [];

                $scope.setMarkers();

            }
        });
    }


    $scope.addPortfolio = function(investment){
    	var flag = false;
    	for (var i = $scope.portfolios.length - 1; i >= 0; i--) {
    		if($scope.portfolios[i].id == investment.id){
    			$scope.portfolios.splice(i,1);
    			flag = true;
                PortfolioService.removePortfolio(investment.id).then(function(data){
                    
                });
    		}
    	}

    	if(!flag){

            $scope.adding = true;
            PortfolioService.addPortfolio(investment.id).then(function(data){
                if(data.success){
                    $scope.portfolios.push(investment);
                } else {
                    alert(data.message);
                }
                $scope.adding = false;
                $scope.show_investement = false;
            });

    	} else {
            $scope.show_investement = false;
        }

        PortfolioService.initials($scope.grouper).then(function(data){
            $scope.setPortfolio(data, 0);
        });

    }

	$scope.initials();
	

});

var map_styles = [
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e9e9e9"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 29
            },
            {
                "weight": 0.2
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 18
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#dedede"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#333333"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f2f2f2"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 17
            },
            {
                "weight": 1.2
            }
        ]
    }
];