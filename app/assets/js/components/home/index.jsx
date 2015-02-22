/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'exports'], function($, Backbone, React, exports) {

  return React.createClass({
    getInitialState: function() {
      return {};
    },
    componentDidMount: function() {

    },
    componentWillUnmount: function() {

    },
    render: function() {
      return (
        <div className="main home">
          <div className="container" style={{textAlign: 'center'}}>
            <i className="fa fa-wifi" style={{fontSize: '300px', color: '#fff'}}></i>
            <div style={{color: '#fff'}}>
              <h1 style={{fontSize: '32px', margin: '0 0 20px 0'}}>WebSense Hub</h1>
              <p style={{fontSize: '18px'}}>Simple consolidation of sensor data.</p>
            </div>
          </div>
        </div>
      );
    }
  });

});
