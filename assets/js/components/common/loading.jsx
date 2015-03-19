/** @jsx React.DOM */

define(['jquery', 'react'], function($, React) {

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
