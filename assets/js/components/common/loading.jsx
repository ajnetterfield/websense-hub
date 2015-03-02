/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'], function($, Backbone, React) {

  return React.createClass({
    render: function() {
      return (
        <div className="loading">
          <i className="fa fa-spinner fa-pulse"></i>
          <div className="message">Loading</div>
        </div>
      );
    }
  });

});
