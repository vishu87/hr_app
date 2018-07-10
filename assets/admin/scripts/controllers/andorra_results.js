app.controller('investorProfileCtrl',function($scope , $http, $interval, UserResultService){

    $scope.loading = true;

    $scope.profiles = [];

    $scope.icons = [
        "Male.svg",
        "Green-Energy.svg",
        "Target.svg",
        "Wallet-2.svg",
        "Sand-watch2.svg",
        "Bar-Chart.svg",
        "Gaugage-2.svg",
        "Environmental-2.svg"
    ];

    $scope.initials = function(){

        UserResultService.updateUser('profile_status',1);

        UserResultService.initials().then(function(data){
            $scope.profiles = data.profile;
            var profile_type = '';
            
            for (var i = 0; i < $scope.profiles[0].value.length; i++) {
                profile_type += ( i == 0) ? $scope.profiles[0].value[i].subtag_name : ', ' + $scope.profiles[0].value[i].subtag_name;
            }
            console.log(profile_type);
            UserResultService.updateUser('type_of_investor',profile_type);
            $scope.loading = false;
        });

    }

    $scope.confirmModal = function(){
        $("#profileModal").modal("show");
    }

    $scope.confirm = function(value){
        $scope.processing = true;
        UserResultService.updateUser('confirm_profile',value).then(function(data){
            $scope.processing = false;
            $scope.hide_confirm = true;
            $("#profileModal").modal("hide");
        });
    }

    $scope.initials();
    
});

app.controller('investorStrategyCtrl',function($scope , $http, $interval, UserResultService){

    $scope.loading = true;

    $scope.risk_score = 0;

    $scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

    $scope.initials = function(){
        
        UserResultService.updateUser('profile_status',2);

        UserResultService.initials().then(function(data){

            $scope.loading = false;

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

            $scope.liquidity_preference_allocation = [];
            $scope.liquidity_preference_colors = [];
            for (var i = data.liquidity_preference_allocation.length - 1; i >= 0; i--) {
                $scope.liquidity_preference_allocation.push({
                    value : data.liquidity_preference_allocation[i].allocation,
                    name : data.liquidity_preference_allocation[i].display_name,
                });
                $scope.liquidity_preference_colors.push(data.liquidity_preference_allocation[i].color);
            }

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
                        value : data.sector_allocation[i].allocation,
                        name : data.sector_allocation[i].sector,
                    });
                    $scope.industry_colors.push(data.sector_allocation[i].color);                    
                }

            }

            $scope.un_goals_allocation = [];
            $scope.un_goals_colors = [];

            for (var i = data.un_goals_allocation.length - 1; i >= 0; i--) {
                $scope.un_goals_allocation.push({
                    value : data.un_goals_allocation[i].allocation,
                    name : data.un_goals_allocation[i].goal,
                });
                $scope.un_goals_colors.push(data.un_goals_allocation[i].color);
            }

            $scope.international_allocation_perc = data.geographic.us_vs_international.international;
            $scope.us_allocation_perc = data.geographic.us_vs_international.us;
            // console.log(data.geographic);
            $scope.geo_allocation = data.geographic.geo_allocation;
            $scope.us_allocation = data.geographic.us_allocation;

            $scope.int_allocation_actual = data.geographic.real_allocation.international;
            $scope.us_allocation_actual = data.geographic.real_allocation.us;

        });

    }

    $scope.regionHover = function(value){
        $scope.displayTooltip = true;
    }

    $scope.regionLeave = function(value){
        $scope.displayTooltip = false;
    }

    $scope.confirmModal = function(){
        $("#strategyModal").modal("show");
    }

    $scope.confirm = function(value){
        $scope.processing = true;
        UserResultService.updateUser('confirm_strategy',value).then(function(data){
            $scope.processing = false;
            $scope.hide_confirm = true;
            $("#strategyModal").modal("hide");
        });
    }

    $scope.initials();
    
});

app.controller('investorDashboardCtrl',function($scope , $http, $interval, $timeout, RecommendationService, PortfolioService){

    $scope.initials = function(){
        
        // RecommendationService.initials().then(function(data){
        //     console.log(data.investments);
        //     $scope.reco_investments = data.investments.splice(0,10);
        //     $timeout(function(){
        //         setSidebar()
        //     }, 200);
        // });

        PortfolioService.initials('major_asset_class').then(function(data){
            $scope.portfolio_amount = data.portfolio_amount;
            $scope.portfolios = data.investments;
            $timeout(function(){
                setSidebar()
            }, 200);
        });

    }

    $scope.initials();
    
});
app.controller('investorRecommendationCtrl',function($scope , $http, $interval, $timeout, RecommendationService, UserResultService, PortfolioService){

    $scope.map_view = false;
    $scope.map_investments = [];
    $scope.markers= [];
    $scope.location_id = 0;
    $scope.geo_location_counts = [];

    $scope.top_matches = true;

    $scope.active_class = '';
    $scope.active_value = 0;

    $scope.portfolios = [];

    $scope.changeView = function(value){
        $scope.map_view = value;

        if($scope.map_view){
            $scope.showm();
        }
    }

    $scope.initials = function(){
        
        UserResultService.updateUser('profile_status',3);

        RecommendationService.initials().then(function(data){

            $scope.reco_filters = data.filters;
            $scope.reco_investments = data.investments;

            for (var i = 0; i < $scope.reco_filters.length; i++) {
                $scope.reco_filters[i].not_found = [];

                for (var k = 0; k < $scope.reco_filters[i].groups.length; k++) {
                    var investments = [];

                    for (var j = 0; j < $scope.reco_investments.length; j++) {
                      var flag = false;

                      if($scope.reco_filters[i].groups[k].field == 'multiple'){
                        
                        if($scope.reco_investments[j][$scope.reco_filters[i].groups[k].match_field].indexOf($scope.reco_filters[i].groups[k].value) != -1 ){
                          flag = true;
                        }

                      } else {
                        if($scope.reco_investments[j][$scope.reco_filters[i].groups[k].match_field] == $scope.reco_filters[i].groups[k].value){
                          flag = true;
                        }
                      }

                      if(flag) investments.push($scope.reco_investments[j]);
                    }
                    
                    $scope.reco_filters[i].groups[k].investments = investments;

                    if(investments.length == 0){
                        $scope.reco_filters[i].not_found.push($scope.reco_filters[i].groups[k]);
                    }
                }
            }

            $scope.map_investments = $scope.reco_investments.slice(0,10);
            $scope.setMarkers();

        });

        $scope.center = new google.maps.LatLng(0,0);
        $scope.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 2,
            center: $scope.center,
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            styles: map_styles
        });

    }

    $scope.showm = function(){

        $("#map").css('height','480px');

        $("#map").animate({
            height : "600px",
        },200,function(){
            google.maps.event.trigger($scope.map,"resize");
            $scope.map.setCenter($scope.center);
        });
    }

    $scope.setMarkers = function (){
        $scope.geo_location_counts = [];
        for (i = 0; i < $scope.map_investments.length; i++){
            createMarker($scope.map_investments[i]);
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

        if(info.impact_locations.length > 0){
            for (var i = 0; i < info.impact_locations.length; i++) {

                if($scope.location_id == 0 || info.impact_locations[i].geo_ids.indexOf($scope.location_id) > -1){
                
                    if($scope.geo_location_counts[info.impact_locations[i].id]){
                        $scope.geo_location_counts[info.impact_locations[i].id]++;
                    } else {
                        $scope.geo_location_counts[info.impact_locations[i].id] = 1;
                    }

                    var latitude = 0;
                    var longitude = 0;

                    latitude = parseFloat(info.impact_locations[i].latitude) + parseFloat(0.5*Math.sin(18*$scope.geo_location_counts[info.impact_locations[i].id]));
                    longitude = parseFloat(info.impact_locations[i].longitude) + parseFloat(0.5*Math.cos(18*$scope.geo_location_counts[info.impact_locations[i].id]));

                    var marker = new google.maps.Marker({
                        map: $scope.map,
                        position: new google.maps.LatLng(latitude, longitude),
                        title: info.product_name,
                        icon: circle
                    });
                    
                    google.maps.event.addListener(marker, 'click', function(){
                        $scope.investmentDetails(info.id, info.product_name);
                    });
                    
                    $scope.markers.push(marker);
                }
            }
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

    $scope.filterMap = function(filter){

        if(filter){
            $scope.active_class = filter.match_field;
            $scope.active_value = filter.value;

            $scope.top_matches = false;
            if(filter.match_field == "impact_areas"){
                $scope.location_id = filter.value;
            } else {
                $scope.location_id = 0;
            }
            $scope.map_investments = filter.investments;
        
        } else {
            $scope.location_id = 0;
            $scope.top_matches = true;
            $scope.map_investments = $scope.reco_investments.slice(0,10);
        }

        for (var i = 0; i < $scope.markers.length; i++ ) {
            $scope.markers[i].setMap(null);
        }
        $scope.markers = [];

        $scope.setMarkers();
    }

    $scope.addPortfolioStart = function(investment){
        $("#amountModal").modal("show");

        $timeout(function(){
            $("#investment_amount").focus();
        },1000);
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

            if($scope.investment_amount <= 0 || $scope.investment_amount == '') {
                return;
            }

            $scope.adding = true;
            PortfolioService.addPortfolio(investment.id, $scope.investment_amount).then(function(data){
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

        $("#amountModal").modal("hide");
        $scope.investment_amount = '';
    }

    $scope.initials();
    
});

app.controller('investorSearchCtrl',function($scope , $http, $interval, $timeout, UserResultService, PortfolioService){

    $scope.markers = [];

    $scope.applied_filters = [];
    $scope.applied_filters_names = [];

    $scope.open_investment = {};
    $scope.show_investement = false;

    $scope.portfolios = [];

    $scope.initials = function(){

        UserResultService.updateUser('profile_status',3);

        UserResultService.initials().then(function(data){

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
            $scope.setMarkers();
        });
       
        $scope.showm();
        $scope.center = new google.maps.LatLng(0,0);
        $scope.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 2,
            center: $scope.center,
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            styles: map_styles
        });
    }

    $scope.showm = function(){

        $("#map").css('height','480px');

        $("#map").animate({
            height : "600px",
        },200,function(){
            google.maps.event.trigger($scope.map,"resize");
            $scope.map.setCenter($scope.center);
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
        
        if(info.latitude != 0 || info.longitude != 0){
            var marker = new google.maps.Marker({
                map: $scope.map,
                position: new google.maps.LatLng(info.latitude, info.longitude),
                title: info.product_name,
                icon: circle
            });
            
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
        console.log(data);
        $http({
            method : "POST",
            url : base_url + '/investor/filter/map',
            data : data,
        }).then(function(response) {
            if(response.status == 200){
                console.log(response.data);
                $scope.investments = response.data.investments;
                for (var i = 0; i < $scope.markers.length; i++ ) {
                  $scope.markers[i].setMap(null);
                }
                $scope.markers = [];

                $scope.setMarkers();

            }
        });
    }

    $scope.showHideFilters = function(){

        $scope.show_filters = !$scope.show_filters;

        $("#search_filters").slideToggle();
    }

    $scope.addPortfolioStart = function(investment){
        $("#amountModal").modal("show");

        $timeout(function(){
            $("#investment_amount").focus();
        },1000);
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

            if($scope.investment_amount <= 0 || $scope.investment_amount == '') {
                return;
            }

            $scope.adding = true;
            PortfolioService.addPortfolio(investment.id, $scope.investment_amount).then(function(data){
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

        $("#amountModal").modal("hide");
        $scope.investment_amount = '';
    }

    $scope.initials();
    
});

app.controller('investorPortfolioCtrl',function($scope , $http, $interval, $timeout, PortfolioService){
    
    $scope.loading = false;

    $scope.initials = function(){
        PortfolioService.initials('major_asset_class').then(function(data){
            $scope.setPortfolio(data, 1);
            $scope.loading = true;
        });
    }

    $scope.setPortfolio = function(data, type){
        
        if(type == 1) {
            $scope.portfolio_sorters = data.sorters;
            $scope.grouper = data.sorter;
        }
        $scope.portfolio_amount = data.portfolio_amount;
        $scope.investment_amount = data.investment_amount;
        
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
        $timeout(function(){
            setSidebar()
        }, 200);
    }

    $scope.portfolioGroup = function(){
        console.log($scope.grouper);
        PortfolioService.initials($scope.grouper).then(function(data){
            $scope.setPortfolio(data, 0);
        });
    }

    $scope.invest = function(investment){
        investment.processing = true;
        PortfolioService.startInvest(investment.id).then(function(data){
            investment.processing = false;
            $scope.portfolioGroup();
        });
    }

    $scope.sell = function(investment){
        investment.processing = true;
        PortfolioService.sellInvestment(investment.id).then(function(data){
            $scope.portfolioGroup();
            investment.processing = false;
        });
    }

    $scope.remove = function(investment){
        investment.processing = true;
        PortfolioService.removePortfolio(investment.id).then(function(data){
            $scope.portfolioGroup();
            investment.processing = false;
        });
    }

    $scope.initials();
    
});

app.controller('andorraRecommendedCtrl',function($scope , $http, $interval, $timeout, RecommendedService, PortfolioService){
    
    $scope.loading = false;
    $scope.asset_classes = [];
    $scope.portfolio_amount = 0;

    $scope.initials = function(){
        RecommendedService.initials().then(function(data){
            $scope.portfolio_amount = parseInt(data.amount_user_want_to_invest);
            $scope.asset_classes = data.recommended_portfolio;
            $scope.loading = true;
            $timeout(function(){
                setSidebar();
            }, 1000);
        });
    }

    $scope.initials();

    $scope.open_investment = {};

    $scope.addPortfolioStart = function(investment){
        $("#amountModal").modal("show");
        $scope.open_investment = investment;
        $timeout(function(){
            $("#investment_amount").focus();
        },1000);
    }

    $scope.addPortfolio = function(investment){

        if($scope.investment_amount <= 0 || $scope.investment_amount == '') {
            return;
        }

        $scope.open_investment.adding = true;

        PortfolioService.addPortfolio(investment.id, $scope.investment_amount).then(function(data){
            $scope.open_investment.adding = false;
            
            if(data.success){
                $scope.open_investment = {};
            } else {
                alert(data.message);
            }
        });


        $("#amountModal").modal("hide");
        $scope.investment_amount = '';
    }
    
});

app.controller('investorImpactCtrl',function($scope , $http, $interval, FinancialReportService){

    $scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

    $scope.initials = function(){
        FinancialReportService.initials().then(function(data){
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
    }

    $scope.initials();
    
});

app.controller('investorImpactBetaCtrl',function($scope , $http, $interval, ImpactReportService){

    $scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];
    $scope.overview = {};
    $scope.graphs = [];
    $scope.footprints = [];

    $scope.regionHover = function(value){
        $scope.displayTooltip = true;
    }

    $scope.regionLeave = function(value){
        $scope.displayTooltip = false;
    }

    $scope.initials = function(){
        ImpactReportService.initials().then(function(data){
            
            console.log(data);

            $scope.overview = data.overview;

            var graph_data = data.asessment;
            for (var i = 0; i < graph_data.length ; i++) {

                var graph = graph_data[i];
                if(graph.data.series1){
                    graph.data.series1 = $scope.convertSeries(graph.data.series1);   
                }
                if(graph.data.series2){
                    graph.data.series2 = $scope.convertSeries(graph.data.series2);   
                }

                $scope.graphs.push(graph_data[i]);
                $scope[graph_data[i].term] = graph_data[i].data;
            }

            $scope.map = data.Map[0];
            $scope.geo_allocation = $scope.map.data.geo_allocation;
            
            var graph_data = data.footprints;
            for (var i = 0; i < graph_data.length ; i++) {
                $scope.footprints.push(graph_data[i]);
                $scope[graph_data[i].term] = graph_data[i].data;
            }

        });
    }

    $scope.convertSeries = function(data){
        var sum = 0;
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i].value);
        }

        for (var i = 0; i < data.length; i++) {
            data[i].perc = (data[i].value*100/sum).toFixed(2);
        }
        return data;
    }

    $scope.initials();
    
});

app.controller('investorFinancialCtrl',function($scope , $http, $interval, FinancialReportService){

    $scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

    $scope.initials = function(){
        FinancialReportService.initials().then(function(data){
            $scope.financial_report = data.financial_report;
      
            $scope.overall_portfolio_return = data.financial_report.overall_portfolio_return;

            $scope.major_asset_class_target = data.financial_report.major_asset_class_target;
                
            $scope.major_asset_class_current = data.financial_report.major_asset_class_current;

            $scope.major_assets = data.financial_report.major_assets;

        });
    }
    
    $scope.initials();
    
});

app.controller('investorCompareCtrl',function($scope , $http, $interval, CompareService){

    $scope.include_cart = true;
    $scope.grouper = 1;

    $scope.$watch('include_cart',function(e){
        $scope.initials();
    });

    $scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

    $scope.initials = function(){
        CompareService.initials($scope.include_cart).then(function(data){
            $scope.classes = data.class_based;
            $scope.sectors = data.sector_based;
            $scope.locations = data.location_based.allocations;
            $scope.unsdgs = data.unsdg_based;
            $scope.liquidities = data.liquidity_preference_based;
        });
    }

    $scope.compareNameColor = function(user_allocation, andorra_allocation, type, class_name){
        var color = '';
        var width = '';
        var step = '';
        var action_type = 2;

        if(user_allocation == andorra_allocation){
            color = '#118610';
            width = 50;
            step = 'Hold';
        } else if( user_allocation < andorra_allocation){
            color = '#118610';
            width = ((user_allocation/andorra_allocation)*100)/2; // this is equivalent to width if max allocation till 50%

            if( (andorra_allocation - user_allocation)/andorra_allocation > 0.2){
                step = 'Buy';
                action_type = 1;
            } else {
                step = 'Hold';
            }

        } else if( user_allocation > andorra_allocation){
            color = '#ff0e00';
            if(andorra_allocation != 0){
                width = 50 + (user_allocation-andorra_allocation)/andorra_allocation*50;
            } else {
                width = 100;
            }

            if(width > 100){
                width = 100;
            }

            if( (user_allocation - andorra_allocation)/andorra_allocation > 0.2){
                step = 'Sell';
                action_type = 3;
            } else {
                step = 'Hold';
            }

        }

        if(type == 1) return color;
        if(type == 2) return action_type;
        if(type == 3) return width;
        if(type == 4) return 'Andorra recommends that you '+ step + ' ' + class_name +'.  Please visit Andorra Recommendations or Search Investments to find investments that will help you match your strategy';
    }
    
    $scope.initials();
    
});

app.controller('investorOwnCtrl',function($scope , $http, $interval, $timeout, OwnService){

    $scope.loading = true;
    $scope.type = 1;
    $scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

    $scope.user_investment = {};

    $scope.initials = function(){
        OwnService.initials().then(function(data){
            $scope.loading = false;
            $scope.portfolio_amount = data.portfolio_amount;
            $scope.investments = data.investments;
            $scope.andorra_investments = data.andorra_investments;
        });

        $scope.type = 0;

        OwnService.compare().then(function(data){

            console.log(data);

            $scope.identified = data.identified;
            $scope.unidentified = data.unidentified;
            
            $scope.type = 1;
            $scope.unidentified_percentage = data.percentage;

            $scope.show_strategy = data.has_user_answered_questions;

            $scope.asset_class_allocation = [];
            $scope.asset_class_colors = [];
            $scope.sub_asset_class_allocation = [];
            $scope.sub_asset_colors = [];

            $scope.asset_class_allocation_andorra = [];
            $scope.asset_class_colors_andorra = [];
            $scope.sub_asset_class_allocation_andorra = [];
            $scope.sub_asset_colors_andorra = [];


            for (var i = data.class_based.length - 1; i >= 0; i--) {
                $scope.asset_class_allocation.push({
                    value : data.class_based[i].user_allocation,
                    name : data.class_based[i].asset_name,
                });
                $scope.asset_class_colors.push(data.class_based[i].color);

                $scope.asset_class_allocation_andorra.push({
                    value : data.class_based[i].andorra_allocation,
                    name : data.class_based[i].asset_name,
                });
                $scope.asset_class_colors_andorra.push(data.class_based[i].color);
                

                if(data.class_based[i].sub_asset_allocation.length > 0 ){
                    for (var j = 0; j < data.class_based[i].sub_asset_allocation.length; j++) {
                        $scope.sub_asset_class_allocation.push({
                            value : data.class_based[i].sub_asset_allocation[j].user_allocation,
                            name : data.class_based[i].sub_asset_allocation[j].sub_asset_name,
                        });
                        $scope.sub_asset_colors.push(data.class_based[i].sub_asset_allocation[j].color);

                        if(data.class_based[i].expandable == 1){
                            $scope.sub_asset_class_allocation_andorra.push({
                                value : data.class_based[i].sub_asset_allocation[j].andorra_allocation,
                                name : data.class_based[i].sub_asset_allocation[j].sub_asset_name,
                            });
                            $scope.sub_asset_colors_andorra.push(data.class_based[i].sub_asset_allocation[j].color);
                        } else {
                            $scope.sub_asset_class_allocation_andorra.push({
                                value : data.class_based[i].andorra_allocation,
                                name : data.class_based[i].asset_name,
                            });
                            $scope.sub_asset_colors_andorra.push(data.class_based[i].color);
                        }
                    }
                } else {
                    $scope.sub_asset_class_allocation.push({
                        value : data.class_based[i].user_allocation,
                        name : data.class_based[i].asset_name,
                    });
                    $scope.sub_asset_colors.push(data.class_based[i].color);

                    $scope.sub_asset_class_allocation_andorra.push({
                        value : data.class_based[i].andorra_allocation,
                        name : data.class_based[i].asset_name,
                    });
                    $scope.sub_asset_colors_andorra.push(data.class_based[i].color);

                }
            }

            console.log($scope.sub_asset_class_allocation_andorra);

            $scope.asset_class_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown*'
            });
            $scope.asset_class_colors.push('#888');

            $scope.sub_asset_class_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown*'
            });
            $scope.sub_asset_colors.push('#888');

            $scope.sector_allocation = [];
            $scope.sector_colors = [];
            $scope.sector_allocation_andorra = [];
            $scope.sector_colors_andorra = [];

            $scope.industry_allocation = [];
            $scope.industry_colors = [];
            $scope.industry_allocation_andorra = [];
            $scope.industry_colors_andorra = [];

            for (var i = data.sector_based.length - 1; i >= 0; i--) {
                $scope.sector_allocation.push({
                    value : data.sector_based[i].user_allocation,
                    name : data.sector_based[i].sector_name,
                });
                $scope.sector_colors.push(data.sector_based[i].color);

                $scope.sector_allocation_andorra.push({
                    value : data.sector_based[i].andorra_allocation,
                    name : data.sector_based[i].sector_name,
                });
                $scope.sector_colors_andorra.push(data.sector_based[i].color);

                if(data.sector_based[i].industry_allocations.length > 0){
                    for (var j = data.sector_based[i].industry_allocations.length - 1; j >= 0; j--) {
                        $scope.industry_allocation.push({
                            value : data.sector_based[i].industry_allocations[j].user_allocation,
                            name : data.sector_based[i].industry_allocations[j].industry_name,
                        });
                        $scope.industry_colors.push(data.sector_based[i].industry_allocations[j].color);

                        $scope.industry_allocation_andorra.push({
                            value : data.sector_based[i].industry_allocations[j].andorra_allocation,
                            name : data.sector_based[i].industry_allocations[j].industry_name,
                        });
                        $scope.industry_colors_andorra.push(data.sector_based[i].industry_allocations[j].color);

                    }
                } else {
                    $scope.industry_allocation.push({
                        value : data.sector_based[i].user_allocation,
                        name : data.sector_based[i].sector_name,
                    });
                    $scope.industry_colors.push(data.sector_based[i].color);

                    $scope.industry_allocation_andorra.push({
                        value : data.sector_based[i].andorra_allocation,
                        name : data.sector_based[i].sector_name,
                    });
                    $scope.industry_colors_andorra.push(data.sector_based[i].color);
                }

            }

            $scope.sector_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown'
            });
            $scope.sector_colors.push('#888');

            $scope.industry_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown'
            });
            $scope.industry_colors.push('#888');

            $scope.location_based = [];
            $scope.location_colors = [];
            $scope.location_based_andorra = [];
            $scope.location_colors_andorra = [];

            var locations = data.location_based.allocations;
            for (var i = locations.length - 1; i >= 0; i--) {
                $scope.location_based.push({
                    value : locations[i].user_allocation,
                    name : locations[i].name,
                });

                $scope.location_colors.push($scope.colors[i]);

                $scope.location_based_andorra.push({
                    value : locations[i].andorra_allocation,
                    name : locations[i].name,
                });
                $scope.location_colors_andorra.push($scope.colors[i]);
            }

            $scope.location_based.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown'
            });
            $scope.location_colors.push('#888');

            $scope.un_goals_allocation = [];
            $scope.un_goals_colors = [];
            $scope.un_goals_allocation_andorra = [];
            $scope.un_goals_colors_andorra = [];

            for (var i = data.unsdg_based.length - 1; i >= 0; i--) {
                $scope.un_goals_allocation.push({
                    value : data.unsdg_based[i].user_allocation,
                    name : data.unsdg_based[i].name,
                });
                $scope.un_goals_colors.push(data.unsdg_based[i].color);

                $scope.un_goals_allocation_andorra.push({
                    value : data.unsdg_based[i].andorra_allocation,
                    name : data.unsdg_based[i].name,
                });
                $scope.un_goals_colors_andorra.push(data.unsdg_based[i].color);
            }

            $scope.un_goals_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown'
            });
            $scope.un_goals_colors.push('#888');

            $scope.category_allocation = [];
            $scope.category_allocation_colors = [];

            for (var i = data.investment_category.length - 1; i >= 0; i--) {
                $scope.category_allocation.push({
                    value : data.investment_category[i].percentage_invested,
                    name : data.investment_category[i].subtag_name,
                });
                $scope.category_allocation_colors.push(data.investment_category[i].color);
            }

            $scope.category_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown*'
            });
            $scope.category_allocation_colors.push('#888');
            
            $scope.financial_versus_impact_allocation = [];
            $scope.financial_versus_impact_colors = [];

            for (var i = data.financial_versus_impact.length - 1; i >= 0; i--) {
                $scope.financial_versus_impact_allocation.push({
                    value : data.financial_versus_impact[i].percentage_invested,
                    name : data.financial_versus_impact[i].subtag_name,
                });
                $scope.financial_versus_impact_colors.push(data.financial_versus_impact[i].color);
            }

            $scope.financial_versus_impact_allocation.push({
                value : $scope.unidentified_percentage,
                name : 'Unknown*'
            });
            $scope.financial_versus_impact_colors.push('#888');

            $timeout(function(){
                setSidebar();
            }, 1000);

        });
    }

    $scope.addModal = function(){
        $scope.user_investment = {};
        $("#entryModal").modal("show");
    }

    $scope.addInvestment = function(){
        $scope.adding = true;
        OwnService.addInvestment($scope.user_investment).then(function(data){
            $scope.adding = false;
            if(data.success){
                $("#entryModal").modal("hide");
                $scope.user_investment = {};
                $scope.initials();
            } else {
                alert(data.message);
            }
        });
    }

    $scope.removeInvestment = function(investment){
        investment.removing = true;
        OwnService.removeInvestment(investment.user_investment_id).then(function(data){
            investment.removing = false;
            if(data.success){
                $scope.initials();
            } else {
                alert(data.message);
            }
        });
    }

    $scope.selectInvestment = function(investment){
        $scope.user_investment.id = investment.id;
        $scope.user_investment.name = investment.name;
        $scope.user_investment.showdrop = false;
    }

    $scope.initials();
    
});


app.controller('investmentAnalyticsCtrl',function($scope , $http, $interval, AnalyticsService){

    $scope.loading = true;
    $scope.loading_data = false;
    $scope.vertical_selection = 0;
    $scope.horizontal_selection = 0;
    $scope.type = 1;

    $scope.modal_investments = [];
    $scope.modal_sub_assets = [];

    $scope.openDetails = function(column){
        $scope.modal_investments = [];
        $scope.modal_sub_assets = [];
        
        if($scope.type == 1){
            for (var i = 0; i < column.investments.length; i++) {
                $scope.modal_investments.push(column.investments[i]);
            }
        } else {
            var sub_assets_ids = [];
            for (var i = 0; i < column.investments.length; i++) {
                if( sub_assets_ids.indexOf(column.investments[i].sub_asset_class_id) == -1){
                    $scope.modal_sub_assets.push(column.investments[i]);
                    sub_assets_ids.push(column.investments[i].sub_asset_class_id);
                }
                
            }
        }

        $("#analyticsModal").modal("show");
    }
    
    $scope.initials = function(){
        AnalyticsService.initials().then(function(data){
            $scope.verticalAxis = data.verticalAxis;
            $scope.horizontalAxis = data.horizontalAxis;
            $scope.loading = false;
        });

        // AnalyticsService.fetch(2,1).then(function(data){
        //     $scope.matrix = data.matrix;
        //     $scope.loading_data = false;
        //     console.log(data);
        // });
    }

    $scope.changeSelection = function(){
        if($scope.vertical_selection != 0 && $scope.horizontal_selection != 0){
            $scope.loading_data = true;
            AnalyticsService.fetch($scope.vertical_selection, $scope.horizontal_selection).then(function(data){
                $scope.matrix = data.matrix;
                $scope.loading_data = false;
                console.log(data);
            });
        }
    }

    $scope.initials();
    
});

app.controller('HistoryUserCtrl',function($scope , $http, $interval){

    $scope.tab = 1;
    
});

app.controller('ProductPageCtrl',function($scope , $http, $interval, InvestmentService, PortfolioService, $timeout){

    $scope.investment_id = 0;
    $scope.investment = {};
    $scope.open_investment = {};

    $scope.loading = true;

    $scope.markers= [];

    $scope.initials = function(){
        InvestmentService.investmentDetails($scope.investment_id).then(function(data){
            $scope.investment = data.investment;
            console.log($scope.investment.impact_areas[0]);
            $scope.loading = false;
            $scope.setMarkers();
        });

        $scope.center = new google.maps.LatLng(0,0);
        $scope.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 2,
            center: $scope.center,
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            styles: map_styles
        });
    }

    $scope.setMarkers = function (){
        for (i = 0; i < $scope.investment.impact_areas.length; i++){
            createMarker($scope.investment.impact_areas[i]);
        }
    }

    var createMarker = function (info){

        var circle = {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: '#F00',
            fillOpacity: .9,
            scale: 5,
            strokeColor: 'white',
            strokeWeight: 1
        };

        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.latitude, info.longitude),
            title: info.geo_name,
            icon: circle
        });
        
        $scope.markers.push(marker);
    }

    $scope.addPortfolioStart = function(investment){
        $("#amountModal").modal("show");
        $scope.open_investment = investment;
        $timeout(function(){
            $("#investment_amount").focus();
        },1000);
    }

    $scope.addPortfolio = function(investment){

        if($scope.investment_amount <= 0 || $scope.investment_amount == '') {
            return;
        }

        $scope.open_investment.adding = true;

        PortfolioService.addPortfolio(investment.id, $scope.investment_amount).then(function(data){
            $scope.open_investment.adding = false;
            
            if(data.success){
                $scope.open_investment = {};
                $scope.investment.in_portfolio = true;
            } else {
                alert(data.message);
            }
        });


        $("#amountModal").modal("hide");
        $scope.investment_amount = '';
    }

    $scope.removeFromPortfolio = function(investment){
        $scope.open_investment.adding = true;
        PortfolioService.removePortfolio(investment.id).then(function(data){
            $scope.investment.in_portfolio = false;
            $scope.open_investment.adding = false;
        });
    }

    $scope.andorraIRR = function(){
        $("#irrModal").modal("show");
    }
    
});

app.controller('ProductPagePDFCtrl',function($scope , $http, $interval, InvestmentService){

    $scope.sections = [
        {
            name : 'Financial Profile',
            items : [
                { name : 'Financial Description', slug : 'financial_product_description', type : 'trix'},
                { name : 'Asset Class', slug : 'asset_class_name', type : 'inline'},
                { name : 'Sub Asset Class', slug : 'sub_asset_class_name', type : 'inline'},
                { name : 'Target IRR', slug : 'target_irr', type : 'inline'},
                { name : 'Return Expectations', slug : 'financial_return_expect_name', type : 'inline'},
                { name : 'Relevant Benchmark', slug : 'relevant_benchmark_name', type : 'inline'},
                { name : 'Time Horizon', slug : 'time_horizon_tag_name', type : 'inline'},
                { name : 'Minimum Investment', slug : 'minimum_investment_size', type : 'inline'},
                { name : 'Ideal Investment Size', slug : 'minimum_investment_size', type : 'inline'}
            ],
            more_tags : true
        },
        {
            name : 'Impact Profile',
            items : [
                { name : 'Impact Description', slug : 'impact_product_description', type : 'trix'},
                { name : 'U.N. SDG', slug : 'impact_goals', type : 'multiple'},
                { name : 'Impact Sector', slug : 'impact_sectors', type : 'multiple'},
                { name : 'Impact Industry', slug : 'impact_industries', type : 'multiple'},
                { name : 'Social enterprise', slug : 'type_social_enterprise_name', type : 'inline'},
                { name : 'Impact Category', slug : 'public_impact_category_name', type : 'inline'},
                { name : 'Third Party Certifications', slug : 'third_party_certifications', type : 'multiple'}
            ],
            more_tags : true
        },
        {
            name : 'Advisor Recommendations',
            items : [
                { name : 'Recommendations', slug : '', type : 'trix'},
            ],
            more_tags : false
        }
    ];

    $scope.initials = function(){
        InvestmentService.investmentDetails($scope.investment_id).then(function(data){
            $scope.investment = data.investment;
            console.log(data.investment);
        });
    }

    $scope.AddTag = function(section){
        if(section.add_more_title && section.add_more_value){
            section.items.push(
                { name : section.add_more_title, slug : section.add_more_value, type : 'inline-self'},
            );
            section.add_more_title = "";
            section.add_more_value = "";
        } else {
            alert("Please fill title and value");
        }
    }
    
});

app.controller('StrategyPDFCtrl',function($scope , $http, $interval, UserResultService){

    $scope.data = {
        profile_type : '',
        impact_sector_preference : '',
        impact_area: 'Asia, USA',
        portfolio_amount: '',
        time_horizon: '',
        cons: 'Concessionary',
    };

    $scope.texts = {
        background: '<p>Silicon Valley Community Foundation is a comprehensive center of philanthropy.  Through visionary leadership, strategic grant making and world-class experiences, we partner with donors to strengthen the common good locally and throughout the world.</p>',
        principles: '<ul><li>Collaboration</li><li><strong>Diversity</strong></li><li>Inclusiveness</li><li>Innovation</li><li>Integrity</li><li>Public Accountability</li><li>Respect</li><li>Responsiveness</li></ul>',
        authority: '<p>Silicon Valley Community Foundations investment committee is responsible for impact investments.</p>',
        objectives: '<p>Concessionary - Slightly Below Market Rate Returns</p>',
        impact_objectives : '<p>Pioneer – Employment & Livelihoods</p><br><ul><li>Socially Responsible Mutual Funds</li><li>Impact Real Estate</li><li>Green Bonds</li><li>CDFI Loans</li><li>Impact Venture Capital</li></ul>',
        risk : '<p><strong>Risk Tolerance: </strong>Moderate Risk</p><p><strong>Risk Score: </strong>7.5</p>',
        issues : '<ul><li>Health & Wellness</li><li>Environment</li><li>Social Justice</li><li>Community Development</li></ul>',
        focus : '',
        criteria : '',
        eligibility : '<p>The Committee is responsible for evaluating prospective investees’ social and financial impact and fit with the Program’s goals and objectives.</p>',
        review : '<p>Based on a discussion of the relative merits and weaknesses, and whether the impact and return objectives can be met, the Committee determines whether to undertake full due diligence. If the Committee does not view the opportunity as viable, it will reject the investment at this stage.</p>',
        diligence : '<p>Depending on the situation, the due diligence process will include a site visit; in-person meetings and/or conference calls with the investee’s management, borrowers, other investors, board members, and if relevant, industry or sector experts and practitioners; and review of audited and interim financial statements, annual reports, and business plans. The due diligence process will also include legal due diligence on whether the potential investee has violated any significant legal or regulatory obligations. </p>',
        approval : '<p>The Investment Overview is the basis for Committee discussion and approval, upon majority vote.</p>',
        monitoring : '<p>Investments will be evaluated on a quarterly basis relative to the going in return projections, operating metrics, and covenants, where applicable. The Silicon Valley Community Foundation is responsible for servicing all impact investments, including receiving and reporting all loan repayments, and notifying borrowers if payments are overdue.  The Investment Committee will main detailed financial record on all impact investments and will produce financial status reports on a quarterly basis for the Committee and participating Donor Advised Funds, if applicable.   </p>',
        reporting : '<p>Investees are generally required to submit quarterly financial statements, annual audited financials, and any other information or metrics agreed to in advance.</p>'

    };

    $scope.sections = [
        {
            name : 'General Overview',
            items : [
                { name : 'Type of Impact Investor', slug : 'profile_type', type : 'inline'},
                { name : 'Impact Sector Preference', slug : 'impact_sector_preference', type : 'inline'},
                { name : 'Impact Area', slug : 'impact_area', type : 'inline'},
                { name : 'Portfolio Objective', slug : 'portfolio_objective', type : 'inline'},
                { name : 'Portfolio Size', slug : 'portfolio_amount', type : 'inline'},
                { name : 'Time Horizon', slug : 'time_horizon', type : 'inline'},
                { name : 'Concessionary vs Non-Concessionary', slug : 'cons', type : 'inline'},
                { name : 'Background', slug : 'background', type : 'trix'},
                { name : 'Defining Principles', slug : 'principles', type : 'trix'},
                { name : 'Authority', slug : 'authority', type : 'trix'},
                { name : 'Financial Objectives', slug : 'objectives', type : 'trix'},
                { name : 'Impact Objectives', slug : 'impact_objectives', type : 'trix'},
                { name : 'Risk', slug : 'risk', type : 'trix'},
                { name : 'Social & Environmental Issues', slug : 'issues', type : 'trix'},
                { name : 'Geographic Focus', slug : 'focus', type : 'trix'},
                { name : 'Other Investment Criteria', slug : 'criteria', type : 'trix'},
            ],
            more_tags : true
        },
        {
            name : 'Investment Process',
            items : [
                { name : 'Impact Criteria Eligibility', slug : 'eligibility', type : 'trix'},
                { name : 'Preliminary Memo', slug : 'memo', type : 'trix'},
                { name : 'Initial Review', slug : 'review', type : 'trix'},
                { name : 'Due Diligence', slug : 'diligence', type : 'trix'},
                { name : 'Investment Memorandum', slug : 'memorandum', type : 'trix'},
                { name : 'Approval', slug : 'approval', type : 'trix'},
                { name : 'Monitoring & Evaluation', slug : 'evaluation', type : 'trix'},
                { name : 'Reporting', slug : 'reporting', type : 'trix'}
            ],
            more_tags : true
        }
    ];

    $scope.initials = function(){
        UserResultService.initials().then(function(data){
            $scope.profiles = data.profile;

            profile_type = '';
            for (var i = 0; i < $scope.profiles[0].value.length; i++) {
                profile_type += ( i == 0) ? $scope.profiles[0].value[i].subtag_name : ', ' + $scope.profiles[0].value[i].subtag_name;
            }
            $scope.data.profile_type = profile_type;

            impact_sector_preference = '';
            for (var i = 0; i < $scope.profiles[7].value.length; i++) {
                impact_sector_preference += ( i == 0) ? $scope.profiles[7].value[i].subtag_name : ', ' + $scope.profiles[7].value[i].subtag_name;
            }
            $scope.data.impact_sector_preference = impact_sector_preference;

            portfolio_objective = '';
            for (var i = 0; i < $scope.profiles[2].value.length; i++) {
                portfolio_objective += ( i == 0) ? $scope.profiles[2].value[i].subtag_name : ', ' + $scope.profiles[2].value[i].subtag_name;
            }
            $scope.data.portfolio_objective = portfolio_objective;

            $scope.data.portfolio_amount = $scope.profiles[3].value;
            

            time_horizon = '';
            for (var i = 0; i < $scope.profiles[4].value.length; i++) {
                time_horizon += ( i == 0) ? $scope.profiles[4].value[i].subtag_name : ', ' + $scope.profiles[4].value[i].subtag_name;
            }
            $scope.data.time_horizon = time_horizon;

            
            $scope.loading = false;
        });
    }

    $scope.AddTag = function(section){
        if(section.add_more_title && section.add_more_value){
            section.items.push(
                { name : section.add_more_title, slug : section.add_more_value, type : 'trix-self'},
            );
            section.add_more_title = "";
            section.add_more_value = "";
        } else {
            alert("Please fill title and value");
        }
    }
    
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