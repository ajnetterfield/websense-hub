/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar'], function($, Backbone, React, Navbar) {

  return React.createClass({
    render: function() {
      return (
        <div className="locations-index">
          <Navbar />
          <div className="main">
            <div className="container">
              <h1>Locations</h1>
            </div>
          </div>
          <div className="react-alert"></div>
        </div>
      );
    }
  });

});
