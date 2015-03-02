/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar', 'components/sensors/list'],
  function($, Backbone, React, Navbar, SensorList) {

  return React.createClass({
    render: function() {
      return (
        <div className="sensors-index">
          <Navbar />
          <div className="main">
            <div className="container">
              <SensorList />
            </div>
          </div>
          <div className="react-alert"></div>
        </div>
      );
    }
  });

});
