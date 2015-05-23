define(['jquery', 'backbone'], function($, Backbone) {

  Sensor = Backbone.Model.extend({
    idAttribute: '@rid',
    initialize: function() {
      this.bind('all', function(e) {
        console.log("Sensor Event: " + e);
      });
      this.bind('invalid', function(model, error) {
        console.log(error);
      });
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
      return response['model'];
    },
    editForm: function() {
      console.log("EDIT FORM");
    }
  });

});
