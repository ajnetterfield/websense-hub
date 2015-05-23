define(['jquery', 'backbone', 'models/sensor'], function($, Backbone) {

  Sensors = Backbone.Collection.extend({
    initialize: function() {
      this.bind('all', function(e) {
        console.log("Sensor Collection Event: " + e);
      });
      this.bind('add', function() {
        console.log("Adding");
      });
      this.bind('remove', function() {
        console.log("Removing");
      });
      this.bind('reset', function() {
        console.log("Resetting");
      });
      this.bind('sort', function() {
        console.log("Sorting");
      });
    },
    model: Sensor,
    comparator: function(sensor1, sensor2) {
      if (sensor1.get('title') > sensor2.get('title')) {
        return 1;
      } else if (sensor1.get('title') < sensor2.get('title')) {
        return -1;
      } else {
        return 0;
      }
    },
    urlRoot: '/api/v1/sensors',
    url: '/api/v1/sensors',
    parse: function(response) {
      console.log("Sensor Collection Parsing Response");
      return response["collection"];
    }
  });

});
