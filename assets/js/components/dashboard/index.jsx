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
        <div className="main">
          <div className="container">
            <h1>Dashboard</h1>
            <div id="highstocks-container" className="highstocks-wrapper" style={{height: '500px', minWidth: '310px'}}></div>
          </div>
        </div>
      );
    }
  });

});
