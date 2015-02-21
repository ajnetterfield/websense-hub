define(['jquery', 'backbone', 'components/sensors/index', 'react'], function($, Backbone, Sensors, React) {
  var initialize  =  function() {
    Router = Backbone.Router.extend({
      routes: {
        '(/)' : 'invokeIndex'
      },
      invokeIndex: function() {
        console.log('Initialising');

        React.render(React.createElement(Sensors, null), $('#react-main')[0])
      },

    });
    new Router();

    Backbone.history.start({ root: 'en', pushState: true, hashChange: false });

  };
  return {
    initialize: initialize
  };
});
