/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'exports'], function($, Backbone, React, exports) {

  return React.createClass({
    getInitialState: function() {
      return {secondsElapsed: 0};
    },
    tick: function() {
      this.setState({secondsElapsed: this.state.secondsElapsed + 1});
    },
    componentDidMount: function() {
      this.interval = setInterval(this.tick, 1000);
    },
    componentWillUnmount: function() {
      clearInterval(this.interval);
    },
    render: function() {
      return (
        <div className="main">
          <div className="container">
            <h1>Sensors</h1>
            <div>Seconds Elapsed: {this.state.secondsElapsed}</div>
          </div>
        </div>
      );
    }
  });

});
