define(['jquery', 'backbone'], function($, Backbone) {

  Measurement = Backbone.Model.extend({
    idAttribute: '@rid',
    initialize: function() {
      // Nothing yet
    },
    validate: function(attributes, options) {
      console.log('validating...');
      if (attributes.title == '') {
        return "Error!";
      }
    },
    urlRoot: '/api/v1/measurements',
    parse: function(response) {
      console.log("Measurements Parsing Response");
      return response['model'];
    }
  });

});
