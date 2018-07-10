app.controller('resultCtrl',function($scope , $http, $interval, UserResultService, $timeout){

	$scope.profiles = [];
	$scope.risk_score = 0;
	$scope.tab_id = 1;

    $scope.markers = [];
	var infoWindow = new google.maps.InfoWindow();

	$scope.applied_filters = [];
	$scope.applied_filters_names = [];

	$scope.open_investment = {};
	$scope.show_investement = false;

	$scope.portfolios = [];

	$scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

	$scope.changeTab = function(tab_id) {
		$scope.tab_id = tab_id;

		if(tab_id == 2){
			// $timeout(function() {

			// 	var major_asset_class_allocation = {
			//         title : {
			// 	        text: 'Major Assets',
			// 	        x: 'center',
			// 	        y: 185
			// 	    },
			//         tooltip: {
			// 	        trigger: 'item',
			// 	        formatter: "{a} <br/>{b} - {d}%"
			// 	    },
			//         series : [
			// 	        {
			// 	            name:'Major Asset Class',
			// 	            type:'pie',
			// 	            radius : ['50%','70%'],
			// 	            data: $scope.major_asset_class_allocation,
			// 	            label: {
			// 	                normal: {
			// 	                    show: true,
			// 	                    position: 'outside',
			// 	                    formatter: "{b}",
			// 	                    textStyle: {
			// 	                        color: 'rgba(0, 0, 0, 0.9)',
			// 	                        fontSize: 14
			// 	                    }
			// 	                },
			// 	            },
			// 	            labelLine: {
			// 	                normal: {
			// 	                    show: true
			// 	                }
			// 	            },
			// 	            itemStyle: {
			// 	                normal: {
			// 	                    shadowBlur: 20,
			// 	                    shadowColor: 'rgba(0, 0, 0, 0.1)'
			// 	                }
			// 	            },

			// 	            animationType: 'scale',
			// 	            animationEasing: 'elasticOut',
			// 	            animationDelay: function (idx) {
			// 	                return Math.random() * 200;
			// 	            }
			// 	        }
			// 	    ],
			// 	    color : $scope.colors
			//     };

			//     var myChart = echarts.init(document.getElementById('major_asset_class_allocation'));
			//     myChart.setOption(major_asset_class_allocation);

			//     var asset_class_allocation = {
			//         title : {
			// 	        text: 'Assets',
			// 	        x: 'center',
			// 	        y: 185
			// 	    },
			//         tooltip: {
			// 	        trigger: 'item',
			// 	        formatter: "{a} <br/>{b} - {d}%"
			// 	    },
			//         series : [
			// 	        {
			// 	            name:'Asset Class',
			// 	            type:'pie',
			// 	            radius : ['50%','70%'],
			// 	            data: $scope.asset_class_allocation,
			// 	            label: {
			// 	                normal: {
			// 	                    show: true,
			// 	                    position: 'outside',
			// 	                    formatter: "{b}",
			// 	                    textStyle: {
			// 	                        color: 'rgba(0, 0, 0, 0.9)',
			// 	                        fontSize: 14
			// 	                    }
			// 	                },
			// 	            },
			// 	            labelLine: {
			// 	                normal: {
			// 	                    show: true
			// 	                }
			// 	            },
			// 	            itemStyle: {
			// 	                normal: {
			// 	                    shadowBlur: 20,
			// 	                    shadowColor: 'rgba(0, 0, 0, 0.1)'
			// 	                }
			// 	            },

			// 	            animationType: 'scale',
			// 	            animationEasing: 'elasticOut',
			// 	            animationDelay: function (idx) {
			// 	                return Math.random() * 200;
			// 	            }
			// 	        }
			// 	    ],
			// 	    color : $scope.colors
			//     };

			//     var myChart = echarts.init(document.getElementById('asset_class_allocation'));
			//     myChart.setOption(asset_class_allocation);

			// 	var sector_allocation_option = {
			//         title : {
			// 	        text: 'Impact Sector',
			// 	        x: 'center',
			// 	        y: 185
			// 	    },
			//         tooltip: {
			// 	        trigger: 'item',
			// 	        formatter: "{a} <br/>{b} - {d}%"
			// 	    },
			//         series : [
			// 	        {
			// 	            name:'Imapct Sector',
			// 	            type:'pie',
			// 	            radius : ['50%','70%'],
			// 	            data: $scope.sector_allocation,
			// 	            label: {
			// 	                normal: {
			// 	                    show: true,
			// 	                    position: 'outside',
			// 	                    formatter: "{b}",
			// 	                    textStyle: {
			// 	                        color: 'rgba(0, 0, 0, 0.9)',
			// 	                        fontSize: 14
			// 	                    }
			// 	                },
			// 	            },
			// 	            labelLine: {
			// 	                normal: {
			// 	                    show: true
			// 	                }
			// 	            },
			// 	            itemStyle: {
			// 	                normal: {
			// 	                    shadowBlur: 20,
			// 	                    shadowColor: 'rgba(0, 0, 0, 0.1)'
			// 	                }
			// 	            },

			// 	            animationType: 'scale',
			// 	            animationEasing: 'elasticOut',
			// 	            animationDelay: function (idx) {
			// 	                return Math.random() * 200;
			// 	            }
			// 	        }
			// 	    ],
			// 	    color : $scope.colors
			//     };

			//     var myChart = echarts.init(document.getElementById('sector_allocation'));
			//     myChart.setOption(sector_allocation_option);

			// 	var industry_allocation_option = {
			//         title : {
			// 	        text: 'Impact Industry',
			// 	        x: 'center',
			// 	        y: 185
			// 	    },
			//         tooltip: {
			// 	        trigger: 'item',
			// 	        formatter: "{a} <br/>{b} - {d}%"
			// 	    },
			//         series : [
			// 	        {
			// 	            name:'Imapct Industry',
			// 	            type:'pie',
			// 	            radius : ['50%','70%'],
			// 	            data: $scope.industry_allocation,
			// 	            label: {
			// 	                normal: {
			// 	                    show: true,
			// 	                    position: 'outside',
			// 	                    formatter: "{b}",
			// 	                    textStyle: {
			// 	                        color: 'rgba(0, 0, 0, 0.9)',
			// 	                        fontSize: 14
			// 	                    }
			// 	                },
			// 	            },
			// 	            labelLine: {
			// 	                normal: {
			// 	                    show: true
			// 	                }
			// 	            },
			// 	            itemStyle: {
			// 	                normal: {
			// 	                    shadowBlur: 20,
			// 	                    shadowColor: 'rgba(0, 0, 0, 0.1)'
			// 	                }
			// 	            },

			// 	            animationType: 'scale',
			// 	            animationEasing: 'elasticOut',
			// 	            animationDelay: function (idx) {
			// 	                return Math.random() * 200;
			// 	            }
			// 	        }
			// 	    ],
			// 	    color : $scope.colors
			//     };

			//     var myChart2 = echarts.init(document.getElementById('industry_allocation'));
			//     myChart2.setOption(industry_allocation_option);

			    
			//     var un_goals_allocation_option = {

			//         title : {
			// 	        text: 'UN Sustainable\n Development Goals',
			// 	        x: 'center',
			// 	        y: 175
			// 	    },
			//         tooltip: {
			// 	        trigger: 'item',
			// 	        formatter: "{a} <br/>{b} - {d}%"
			// 	    },
			//         series : [
			// 	        {
			// 	            name:'Imapct Industry',
			// 	            type:'pie',
			// 	            radius : ['50%','70%'],
			// 	            data: $scope.un_goals_allocation,
			// 	            label: {
			// 	                normal: {
			// 	                    show: true,
			// 	                    position: 'outside',
			// 	                    formatter: "{b}",
			// 	                    textStyle: {
			// 	                        color: 'rgba(0, 0, 0, 0.9)',
			// 	                        fontSize: 14
			// 	                    }
			// 	                },
			// 	            },
			// 	            labelLine: {
			// 	                normal: {
			// 	                    show: true
			// 	                }
			// 	            },
			// 	            itemStyle: {
			// 	                normal: {
			// 	                    shadowBlur: 20,
			// 	                    shadowColor: 'rgba(0, 0, 0, 0.1)'
			// 	                }
			// 	            },

			// 	            animationType: 'scale',
			// 	            animationEasing: 'elasticOut',
			// 	            animationDelay: function (idx) {
			// 	                return Math.random() * 200;
			// 	            }
			// 	        }
			// 	    ],
			// 	    color : $scope.colors
			//     };

			//     var myChart3 = echarts.init(document.getElementById('un_goals_allocation'));
			//     myChart3.setOption(un_goals_allocation_option);

			// }, 500);
		}

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
			console.log(data);
			$scope.profiles = data.profile;
			$scope.risk_score = data.risk_score;

			$scope.major_asset_class_allocation = [];

			for (var i = data.major_asset_class_allocation.length - 1; i >= 0; i--) {
				$scope.major_asset_class_allocation.push({
					value : data.major_asset_class_allocation[i].allocation,
					name : data.major_asset_class_allocation[i].major_asset_class,
				});
			}

			$scope.asset_class_allocation = [];

			for (var i = data.asset_class_allocation.length - 1; i >= 0; i--) {
				$scope.asset_class_allocation.push({
					value : data.asset_class_allocation[i].allocation,
					name : data.asset_class_allocation[i].asset_class.subtag_name,
				});
			}

			$scope.sector_allocation = [];

			for (var i = data.sector_allocation.length - 1; i >= 0; i--) {
				$scope.sector_allocation.push({
					value : data.sector_allocation[i].allocation,
					name : data.sector_allocation[i].sector.subtag_name,
				});
			}

		    $scope.industry_allocation = [];

			for (var i = data.industry_allocation.length - 1; i >= 0; i--) {
				for (var j = data.industry_allocation[i].industry_allocation.length - 1; j >= 0; j--) {
					$scope.industry_allocation.push({
						value : data.industry_allocation[i].industry_allocation[j].allocation,
						name : data.industry_allocation[i].industry_allocation[j].industry.subtag_name,
					});
				}
			}

			$scope.un_goals_allocation = [];

			for (var i = data.un_goals_allocation.length - 1; i >= 0; i--) {
				$scope.un_goals_allocation.push({
					value : data.un_goals_allocation[i].allocation,
					name : data.un_goals_allocation[i].goal,
				});
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
			
		});
	}

	$scope.setMarkers = function (){
        
        for (i = 0; i < $scope.investments.length; i++){
            createMarker($scope.investments[i]);
        }
    }

    var createMarker = function (info){
    	console.log(info);
        if(info.latitude != 0 || info.longitude != 0){
            var marker = new google.maps.Marker({
                map: $scope.map,
                position: new google.maps.LatLng(info.latitude, info.longitude),
                title: info.product_name,
            });
            // marker.content = '<div class="infoWindowContent" style="text-align:center"><span style="font-size:16px; font-weight:bold; max-width: 250px; display: block; text-align: center;">' + info.name + '</span></div> <div style="text-align:center">';
            // if(info.photo1 != '') marker.content += '<img src="'+ info.photo1 +'" style="margin-top:10px; height:100px; width:auto">';
            // marker.content += '</div><div style="text-align:center; margin-top:8px">Technology: <b>'+ info.technology_name+'</b><br>';
            
            // if(info.installed_capacity){
            //     marker.content += 'Installed Capacity: <b>'+info.installed_capacity+'MW</b><br>';
            // }

            // marker.content += '<a href="'+base_url+'/project/'+info.id+'" style="color:#00AF50" target="_blank">View Project</a></div>';
            
            google.maps.event.addListener(marker, 'click', function(){
                $scope.investmentDetails(info.id);
            });
            
            $scope.markers.push(marker);
        }
    }

    $scope.investmentDetails = function(id){
    	
    	$scope.show_investement = true;
    	$scope.open_investment = {};
    	UserResultService.investmentDetails(id).then(function(data){
			$scope.open_investment = data.investment;
		});
    }


    $scope.addFilter = function(type, id, name, filter){
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

    	console.log($scope.applied_filters_names);
    }


    $scope.addPortfolio = function(investment){
    	var flag = false;
    	for (var i = $scope.portfolios.length - 1; i >= 0; i--) {
    		if($scope.portfolios[i].id == investment.id){
    			$scope.portfolios.splice(i,1);
    			flag = true;
    		}
    	}
    	if(!flag){
    		$scope.portfolios.push(investment);
    	}
    }

	$scope.initials();
	

});

var map_styles = [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8ec3b9"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1a3646"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4b6878"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#64779e"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4b6878"
      }
    ]
  },
  {
    "featureType": "landscape.man_made",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#334e87"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#283d6a"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#6f9ba5"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3C7680"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#304a7d"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#98a5be"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2c6675"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#255763"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#b0d5ce"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#98a5be"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#283d6a"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3a4762"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#0e1626"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#4e6d70"
      }
    ]
  }
];