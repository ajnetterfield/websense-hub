define(['jquery', 'underscore', 'backbone', 'react', 'bootstrap', 'highstock',
    'components/common/navbar',
    'components/page_not_found/index',
    'components/home/index',
    'components/dashboard/index',
    'components/sensors/index',
    'components/locations/index'
  ], 
  function($, Underscore, Backbone, React, Bootstrap, Highstock,
    Navbar,
    PageNotFoundIndex,
    HomeIndex,
    DashboardIndex,
    SensorIndex,
    LocationsIndex
  ) {

  var initialize  =  function() {
    Router = Backbone.Router.extend({
      routes: {
        '' : 'home',
        'dashboard' : 'dashboard',
        'sensors' : 'sensors',
        'locations' : 'locations',
        '*splat' : 'page_not_found'
      },
      home: function() {
        console.log('Initialising Home');
        React.render(React.createElement(HomeIndex, null), $('body')[0]);
      },
      dashboard: function() {
        console.log('Initialising Dashboard');
        React.render(React.createElement(DashboardIndex, null), $('body')[0]);
      },
      sensors: function() {
        console.log('Initialising Sensors');
        React.render(React.createElement(SensorIndex, null), $('body')[0]);
      },
      locations: function() {
        console.log('Initialising Locations');
        React.render(React.createElement(LocationsIndex, null), $('body')[0]);
      },
      page_not_found: function() {
        console.log('Initialising Page Not Found');
        React.render(React.createElement(PageNotFoundIndex, null), $('body')[0]);
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
