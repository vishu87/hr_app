var app = angular.module('app', [
	'jcs-autoValidate',
	'ngFileUpload',
	'angular-ladda',
	'datatables',
	'720kb.tooltips',
  'angular-popover',
	'ngImgCrop',
  'multipleSelect',
  'isteven-multi-select',
  'rzModule',
  'dragularModule',
  'selectize',
  'angularTrix',
  'ngSanitize'
]);

angular.module('jcs-autoValidate')
    .run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
          errorMessages['patternInt'] = 'Please fill a numeric value';
          errorMessages['patternFloat'] = 'Please fill a numeric/decimal value';
        });
    }
]);

// app.filter('reverse', function() {
//   if(items){
//     return function(items) {
//       return items.slice().reverse();
//     };
//   }
// });

app.directive('convertToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(val) {
        return val != null ? parseInt(val, 10) : null;
      });
      ngModel.$formatters.push(function(val) {
        return val != null ? '' + val : null;
      });
    }
  };
});


app.directive('svgMapUs', ['$compile', function ($compile) {
    return {
      restrict: 'A',
      templateUrl: base_url + '/assets/maps/us_map.svg?v=1.1.1',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.state');
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("region", "");
            regionElement.attr("type", "3");
            regionElement.attr("question-id", attrs.questionId);
            $compile(regionElement)(scope);
          });
      }
    }
}]);

app.directive('svgMapContinent', ['$compile', function ($compile) {
    return {
      restrict: 'A',
      templateUrl: base_url + '/assets/maps/continents.svg',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.state');
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("region", "");
            regionElement.attr("type", "1");
            regionElement.attr("question-id", attrs.questionId);
            $compile(regionElement)(scope);
          });
      }
    }
}]);

app.directive('svgMapWorld', ['$compile', function ($compile) {
    return {
      restrict: 'A',
      templateUrl: base_url + '/assets/maps/worldLow2.svg',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.state');
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("region", "");
            regionElement.attr("type", "2");
            regionElement.attr("question-id", attrs.questionId);
            $compile(regionElement)(scope);
          });
      }
    }
}]);

app.directive('svgMapWorldPortfolio', ['$compile', function ($compile) {
    return {
      restrict: 'A',
      templateUrl: base_url + '/assets/maps/worldLow2.svg',
      link: function (scope, element, attrs) {
          var geo_allocations = scope.geo_allocation;
          var regions = element[0].querySelectorAll('.state');
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            var id = parseInt(regionElement.attr("data-id"));
            var flag = false;
            for (var i = geo_allocations.length - 1; i >= 0; i--) {
              if(geo_allocations[i].id == id) {
                flag = true;
                regionElement.addClass("selected");
                regionElement.attr("map-low", "");
                regionElement.attr("title", geo_allocations[i].name + ' ' + geo_allocations[i].allocation + '%');

                var dt = parseInt(geo_allocations[i].allocation);
                var color_code = "rgb("+ (125 - dt) + ","+ (155 - dt) + ","+ (255 - dt) + ")";
                regionElement.css("fill",color_code);

                $compile(regionElement)(scope);
                break;
              }
            };
          });
      }
    }
}]);

app.directive('mapLow', ['$compile', function ($compile) {
    return {
        restrict: 'EA',
        scope: false,
        link: function (scope, element, attrs) {
          element.on('mousemove', function(event) {
                $(".tooltipMap").html(element.attr("title"));
                $(".tooltipMap").css({
                  left : event.pageX + 20,
                  top: event.pageY + 20
                });
            });
            element.attr("ng-mouseenter", "regionHover('"+element.attr("id")+"')");
            element.attr("ng-mouseleave", "regionLeave('"+element.attr("id")+"')");
            element.removeAttr("map-low");
            $compile(element)(scope);
        }
    }
}]);

app.directive('region', ['$compile', function ($compile) {
    return {
        restrict: 'EA',
        scope: false,
        link: function (scope, element, attrs) {
            element.attr("ng-click", 'regionClick("'+element.attr('title')+'","'+element.attr('data-id')+'","'+element.attr('question-id')+'","'+element.attr('id')+'",'+element.attr('type')+')');
            
            element.on('mousemove', function(event) {
                $(".tooltipMap").html(element.attr("title"));
                $(".tooltipMap").css({
                  left : event.pageX + 20,
                  top: event.pageY + 20
                });
            });

            element.attr("ng-mouseenter", "regionHover('"+element.attr("id")+"')");
            element.attr("ng-mouseleave", "regionLeave('"+element.attr("id")+"')");

            element.removeAttr("region");
            $compile(element)(scope);
        }
    }
}]);

app.directive('eChart', ['$compile', function ($compile) {
    return {
      restrict: 'EA',
      template: '<div class="chartarea" style="width:550px; height:400px"></div>',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.chartarea');

          var division_id = attrs.dataid;
          var data_link = attrs.datagraph;
          var data = scope[data_link];

          var name = attrs.dataname;
          var title = name;

          var titlehide = attrs.titlehide;
          console.log(name, titlehide);
          if(titlehide == "true") title = '';

          var colors = (attrs.colors) ? scope[attrs.colors] : scope.colors;
          
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("id", division_id);
          });

          var options = {
                title : {
                  text: title,
                  x: 'center',
                  y: 185
              },
                tooltip: {
                  trigger: 'item',
                  formatter: "{a} <br/>{b} - {d}%"
              },
                series : [
                  {
                      name: name,
                      type:'pie',
                      radius : ['50%','70%'],
                      data: data,
                      label: {
                          normal: {
                              show: false,
                              position: 'outside',
                              formatter: "{b}",
                              textStyle: {
                                  color: 'rgba(0, 0, 0, 0.9)',
                                  fontSize: 14
                              }
                          },
                      },
                      labelLine: {
                          normal: {
                              show: true
                          }
                      },
                      itemStyle: {
                          normal: {
                              shadowBlur: 20,
                              shadowColor: 'rgba(0, 0, 0, 0.1)'
                          }
                      },

                      animationType: 'scale',
                      animationEasing: 'elasticOut',
                      animationDelay: function (idx) {
                          return Math.random() * 200;
                      }
                  }
              ],
              color : colors
            };

            setTimeout(function(){
              var myChart = echarts.init(document.getElementById(division_id));
              myChart.setOption(options);
            }, 2000);
      }
    }
}]);

app.directive('eChartSmall', ['$compile', function ($compile) {
    return {
      restrict: 'EA',
      template: '<div class="chartarea" style="width:300px; height:300px"></div>',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.chartarea');

          var division_id = attrs.dataid;
          var data_link = attrs.datagraph;
          var data = scope[data_link];

          var name = attrs.dataname;
          var title = name;

          var titlehide = attrs.titlehide;
          console.log(name, titlehide);
          if(titlehide == "true") title = '';

          var colors = (attrs.colors) ? scope[attrs.colors] : scope.colors;
          
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("id", division_id);
          });

          var options = {
                title : {
                  text: title,
                  x: 'center',
                  y: 185
              },
                tooltip: {
                  trigger: 'item',
                  formatter: "{b}<br>{d}%"
              },
                series : [
                  {
                      name: name,
                      type:'pie',
                      radius : ['45%','70%'],
                      data: data,
                      label: {
                          normal: {
                              show: false,
                          },
                      },
                      labelLine: {
                          normal: {
                              show: false
                          }
                      },
                      itemStyle: {
                          normal: {
                              shadowBlur: 20,
                              shadowColor: 'rgba(0, 0, 0, 0.1)'
                          }
                      },

                      animationType: 'scale',
                      animationEasing: 'elasticOut',
                      animationDelay: function (idx) {
                          return Math.random() * 200;
                      }
                  }
              ],
              color : colors
            };

            setTimeout(function(){
              var myChart = echarts.init(document.getElementById(division_id));
              myChart.setOption(options);
            }, 2000);
      }
    }
}]);

app.directive('eLineChart', ['$compile', function ($compile) {
    return {
      restrict: 'EA',
      template: '<div class="chartarea" style="width:550px; height:300px"></div>',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.chartarea');

          var division_id = attrs.dataid;
          var data_link = attrs.datagraph;
          var data = scope[data_link];

          var xaxis_data = [];
          var yaxis_data = [];

          for (var i = 0; i < data.length; i++) {
            xaxis_data.push(data[i].name);
            yaxis_data.push(data[i].value);
          }
          
          var name = attrs.dataname;
          
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("id", division_id);
          });
          
          var options = {
              title: {
                  show: false,
                  text: 'Step Line'
              },
              tooltip: {
                  trigger: 'axis'
              },
              grid: {
                  left: '3%',
                  right: '4%',
                  bottom: '3%',
                  containLabel: true
              },
              xAxis: {
                  type: 'category',
                  data: xaxis_data
              },
              yAxis: {
                  type: 'value'
              },
              series: [
                  {
                      name: 'Step Start',
                      type: 'line',
                      step: 'start',
                      data: yaxis_data
                  }
              ]
            };

            setTimeout(function(){
              var myChart = echarts.init(document.getElementById(division_id));
              myChart.setOption(options);
            }, 2000);
      }
    }
}]);


// app.directive('eBarChart', ['$compile', function ($compile) {
//     return {
//       restrict: 'EA',
//       template: '<div class="chartarea" style="width:500px; height:300px; margin: 0 auto;"></div>',
//       link: function (scope, element, attrs) {
//           var regions = element[0].querySelectorAll('.chartarea');

//           var division_id = attrs.dataid;
//           var data_link = attrs.datagraph;
//           var data = scope[data_link];
//           var name = attrs.dataname;
          
//           angular.forEach(regions, function (path, key) {
//             var regionElement = angular.element(path);
//             regionElement.attr("id", division_id);
//           });

//           var labels = [];
//           var values = [];
//           console.log(data);
//           for (var i = 0; i < data.length; i++) {
//             labels.push(data[i].name);
//             values.push(data[i].value);
//           };

//           console.log(labels, values);

//           var options = {
//                   title : {
//                     show : false
//                   },
//                   legend: {
//                     show : false
//                   },
//                   tooltip: {
//                       trigger: 'axis',
//                       axisPointer : {
//                           type : 'shadow'
//                       }
//                   },
//                    grid: {
//                       left: '3%',
//                       right: '4%',
//                       bottom: '3%',
//                       containLabel: true
//                   },
//                   xAxis: {
//                       type: 'category',
//                       axisTick: {
//                           alignWithLabel: true
//                       },
//                       data: labels
//                   },
//                   yAxis: {
//                     type: 'value'
//                   },
//                   series: [{
//                       name: 'perc',
//                       type: 'bar',
//                       barWidth: '40%',
//                       data: values
//                     }, 
//                 ],
//                 label: {
//                     normal: {
//                         show: true,
//                         position: 'top',
//                         formatter: '{c}%',
//                         textStyle: {
//                           color: '#f00',
//                           fontSize: '14px',
//                       }
//                     },
//                     emphasis: {
//                         show: true,
//                         position: 'top',
//                         formatter: '{c}%',
//                         textStyle: {
//                           color: '#999',
//                           fontSize: '14px',
//                       }
//                     }
//                 },
//                 itemStyle: {
//                   normal: {
//                       color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
//                           offset: 0,
//                           color: 'rgba(17, 168,171, 1)'
//                       }, {
//                           offset: 1,
//                           color: 'rgba(17, 168,171, 0.1)'
//                       }]),
//                       shadowColor: 'rgba(0, 0, 0, 0.1)',
//                       shadowBlur: 10
//                   }
//               }
//               };

//             setTimeout(function(){
//               var myChart = echarts.init(document.getElementById(division_id));
//               myChart.setOption(options);
//             }, 2000);
//       }
//     }
// }]);

app.directive('ePieChart', ['$compile', function ($compile) {
    return {
      restrict: 'EA',
      template: '<div class="chartarea" style="width:300px; height:300px"></div>',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.chartarea');

          var division_id = attrs.dataid;
          var data_link = attrs.datagraph;
          var data = scope[data_link];

          var name = attrs.dataname;

          var colors = (attrs.colors) ? scope[attrs.colors] : scope.colors;
          
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("id", division_id);
          });

          var options = {
              title : {
                  text: name,
                  x: 'center',
                  y: 135
              },
              tooltip: {
                  trigger: 'item',
                  formatter: "{b}<br>{d}%",
                  extraCssText: "",
                  textStyle: {
                    fontSize: 12,
                  }
              },
                series : [
                  {
                      name: name,
                      type:'pie',
                      radius : ['50%','90%'],
                      data: data,
                      label: {
                          normal: {
                              show: false,
                              position: 'outside',
                              formatter: "{b}",
                              textStyle: {
                                  color: 'rgba(0, 0, 0, 0.9)',
                                  fontSize: 14
                              }
                          },
                      },
                      labelLine: {
                          normal: {
                              show: false
                          }
                      },
                      itemStyle: {
                          normal: {
                              shadowBlur: 20,
                              shadowColor: 'rgba(0, 0, 0, 0.1)'
                          }
                      },

                      animationType: 'scale',
                      animationEasing: 'elasticOut',
                      animationDelay: function (idx) {
                          return Math.random() * 200;
                      }
                  }
              ],
              color : colors
            };

            setTimeout(function(){
              var myChart = echarts.init(document.getElementById(division_id));
              myChart.setOption(options);
            }, 2000);
      }
    }
}]);


app.directive('svgMapUsPortfolio', ['$compile', function ($compile) {
    return {
      restrict: 'A',
      templateUrl: base_url + '/assets/maps/us_map.svg',
      link: function (scope, element, attrs) {
          var us_allocations = scope.us_allocation;
          var regions = element[0].querySelectorAll('.state');
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            var id = parseInt(regionElement.attr("data-id"));
            var flag = false;
            for (var i = us_allocations.length - 1; i >= 0; i--) {
              if(us_allocations[i].id == id) {
                flag = true;
                regionElement.addClass("selected");
                regionElement.attr("map-low", "");
                regionElement.attr("title", us_allocations[i].name + ' ' + us_allocations[i].allocation + '%');

                // var color_id = 0;
                // if( us_allocations[i].allocation % 10 == 0){
                //   color_id = us_allocations[i].allocation/10 - 1;
                // } else {
                //    color_id = parseInt(us_allocations[i].allocation/10);
                // }
                var opacity = us_allocations[i].allocation/100;
                var dt = parseInt(us_allocations[i].allocation);

                var color_code = "rgb("+ (125 - dt) + ","+ (155 - dt) + ","+ (255 - dt) + ")";
                regionElement.css("fill",color_code);
                // regionElement.css("opacity",opacity);

                $compile(regionElement)(scope);
                break;
              }
            };
          });
      }
    }
}]);

app.directive('eChartDouble', ['$compile', function ($compile) {
    return {
      restrict: 'EA',
      template: '<div class="chartarea" style="width:350px; height:360px"></div>',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.chartarea');

          var division_id = attrs.dataid;
          var data_link = attrs.datagraph;
          var data = scope[data_link];

          var name = attrs.dataname;
          var title = name;

          var colors1 = [];
          for (var i = 0; i < data.series1.length; i++) {
            colors1.push(data.series1[i].color);
            if(data.series1[i].name == 'Unknown'){
              data.series1[i].name = "Unknown ";
            }
            // data.series1[i].name = data.series1[i].name.split(" ").join("\n")
          };

          var colors2 = [];
          for (var i = 0; i < data.series2.length; i++) {
            colors2.push(data.series2[i].color);
            // data.series2[i].name = data.series2[i].name.split(" ").join("\n")
          };
          
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("id", division_id);
          });

          var options = {
                title : {
                  text: title,
                  x: 'center',
                  y: 185
              },
                tooltip: {
                  trigger: 'item',
                  formatter: "{b}<br>{d}%",
                  textStyle: {
                    fontSize: 12
                  }
              },
              series : [
                  {
                      name: name,
                      type:'pie',
                      id:data_link+'_2',
                      radius : ['40%','80%'],
                      data: data.series2,
                      label: {
                          normal: {
                              show: false,
                            },
                      },
                      itemStyle: {
                          normal: {
                              shadowBlur: 20,
                              shadowColor: 'rgba(0, 0, 0, 0.1)'
                          }
                      },

                      animationType: 'scale',
                      animationEasing: 'elasticOut',
                      animationDelay: function (idx) {
                          return Math.random() * 200;
                      },
                      color : colors2
                  },
                  {
                      name: name,
                      type:'pie',
                      radius : ['0%','40%'],
                      data: data.series1,
                      id:data_link+'_1',
                      label: {
                          normal: {
                              show: false,
                              position: 'outside',
                              formatter: "{b}",
                              textStyle: {
                                  color: 'rgba(0, 0, 0, 0.9)',
                                  fontSize: 14
                              }
                          },
                      },
                      labelLine: {
                          normal: {
                              show: true
                          }
                      },
                      animationType: 'scale',
                      animationEasing: 'elasticOut',
                      animationDelay: function (idx) {
                          return Math.random() * 200;
                      },
                      color : colors1
                  }
              ],
              
            };

            setTimeout(function(){
              var myChart = echarts.init(document.getElementById(division_id));
              myChart.setOption(options);
              myChart.on('mouseover', eConsole);
              myChart.on('mouseout', eConsoleOut);
            }, 2000);
      }
    }
}]);

app.directive('eChartSankey', ['$compile', function ($compile) {
    return {
      restrict: 'EA',
      template: '<div class="chartarea" style="width:100%; height:400px"></div>',
      link: function (scope, element, attrs) {
          var regions = element[0].querySelectorAll('.chartarea');

          var division_id = attrs.dataid;
          var data_link = attrs.datagraph;
          var data = scope[data_link];

          for (var i = 0; i < data.nodes.length; i++) {
            // data.nodes[i].name = data.nodes[i].name.split(" ").join("\n");
          }
          // console.log(data.nodes);

          var name = attrs.dataname;
          var title = name;

          var colors = (attrs.colors) ? scope[attrs.colors] : scope.colors;
          
          angular.forEach(regions, function (path, key) {
            var regionElement = angular.element(path);
            regionElement.attr("id", division_id);
          });

          var options = {
              title : {
                  text: title,
                  x: 'center',
                  y: 185
              },

              series: [
                {
                  type: 'sankey',
                  layout: 'none',
                  data: data.nodes,
                  links: data.links,
                  itemStyle: {
                      normal: {
                          borderWidth: 1,
                          borderColor: '#aaa'
                      }
                  },
                  lineStyle: {
                      normal: {
                          color: 'source',
                          curveness: 0.5
                      }
                  }
                }
              ],
              color : colors
            };

            setTimeout(function(){
              var myChart = echarts.init(document.getElementById(division_id));
              myChart.setOption(options);
            }, 2000);
      }
    }
}]);