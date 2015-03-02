/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar'], function($, Backbone, React, Navbar) {

  return React.createClass({
    render: function() {
      return (
        <div className="home-index cover-wrapper">
          <Navbar />
          <div className="cover">
            <div className="cover-inner home">
              <i className="fa fa-wifi" style={{fontSize: '300px', color: '#fff'}}></i>
              <div style={{color: '#fff'}}>
                <h1 style={{fontSize: '32px', margin: '0 0 20px 0'}}>WebSense Hub</h1>
                <p style={{fontSize: '18px'}}>Simple consolidation of sensor data.</p>
              </div>
            </div>
          </div>
        </div>
      );
    }
  });

});
