define(['jquery', 'underscore', 'backbone', 'react', 'bootstrap', 'highstock',
  'components/common/navbar', 
  'components/home/index', 
  'components/sensors/index',
  'components/dashboard/index',
  ], 
  function($, Underscore, Backbone, React, Bootstrap, Highstock,
    Navbar, 
    Home, 
    Sensors,
    Dashboard
  ) {

  var initialize  =  function() {
    Router = Backbone.Router.extend({
      routes: {
        'dashboard' : 'dashboard',
        'sensors' : 'sensors',
        'locations' : 'locations',
        '' : 'home',
        '*splat' : 'page_not_found'
      },
      page_not_found: function() {
        console.log('Initialising Page Not Found');
        React.render(React.createElement(Navbar, null), $('#react-header')[0]);
        React.render(React.createElement(Home, null), $('#react-body')[0]);
      },
      home: function() {
        console.log('Initialising Home');
        React.render(React.createElement(Navbar, null), $('#react-header')[0]);
        React.render(React.createElement(Home, null), $('#react-body')[0]);
      },
      dashboard: function() {
        console.log('Initialising Dashboard');
        React.render(React.createElement(Navbar, null), $('#react-header')[0]);
        React.render(React.createElement(Dashboard, null), $('#react-body')[0]);

        var data = [
          [1147651200000,67.79],
          [1147737600000,64.98],
          [1147824000000,65.26],
          [1147910400000,63.18],
          [1147996800000,64.51],
          [1148256000000,63.38],
          [1148342400000,63.15],
          [1148428800000,63.34],
          [1148515200000,64.33],
          [1148601600000,63.55],
          [1148947200000,61.22],
          [1149033600000,59.77]
        ];

        $(function () {
          $('#highstocks-container').highcharts('StockChart', {
            rangeSelector : {
              selected : 1
            },
            title : {
              text : 'BOM Temperature'
            },
            series : [{
              name : 'BOM',
              data : data,
              tooltip: {
                valueDecimals: 2
              }
            }]
          });
        });

      },
      sensors: function() {
        console.log('Initialising Sensors');
        React.render(React.createElement(Navbar, null), $('#react-header')[0]);
        React.render(React.createElement(Sensors, null), $('#react-body')[0]);
      },
      locations: function() {
        console.log('Initialising Locations');
        React.render(React.createElement(Navbar, null), $('#react-header')[0]);
        React.render(React.createElement(Sensors, null), $('#react-body')[0]);
      },
    });
    var router = new Router();

    $(document).on("click", "a[href^='/']", function(event) {
      var href = $(event.currentTarget).attr('href');
      if (!event.altKey && !event.ctrlKey && !event.metaKey && !event.shiftKey) {
        event.preventDefault();
        url = href.replace(/^\//,'').replace('\#\!\/','');
        router.navigate(url, { trigger: true });
        return false;
      }
    });

    Backbone.history.start({ root: '/app/', pushState: true, hashChange: false });
  };
  return {
    initialize: initialize
  };
});
