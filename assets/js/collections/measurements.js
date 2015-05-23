define(['jquery', 'backbone', 'models/measurement'], function($, Backbone) {

  Measurements = Backbone.Collection.extend({
    initialize: function() {
      // Nothing yet
    },
    model: Measurement,
    urlRoot: '/api/v1/measurements',
    url: '/api/v1/measurements',
    parse: function(response) {
      console.log("Measurement Collection Parsing Response");
      return response["collection"];
    }
  });

});
