define(['jquery', 'backbone'], function($, Backbone) {

  Sensor = Backbone.Model.extend({
    initialize: function() {
      this.bind('all', function(e) {
        console.log("Sensor Event: " + e);
      });
      this.bind('change:title', function() {
        console.log("Changed Title: " + this.get('title'));
      });
      this.bind('invalid', function(model, error) {
        console.log(error);
      });
    },
    defaults: {
      title: '',
      sensor_id: '',
      location: ''
    },
    validate: function(attributes, options) {
      console.log('validating...');
      if (attributes.title == '') {
        return "Error!";
      }
    },
    urlRoot: '/api/v1/sensors',
    parse: function(response) {
      console.log("Sensors Parsing Response");
      return response['payload'];
    }
  });

});
