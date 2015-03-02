/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'], function($, Backbone, React) {

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
        <div className="navbar navbar-default navbar-fixed-top" role="navigation">
          <div className="container">
            <div className="navbar-header">
              <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span className="sr-only">Toggle navigation</span>
                <span className="icon-bar"></span>
                <span className="icon-bar"></span>
                <span className="icon-bar"></span>
              </button>
              <a className="navbar-brand" href="/"><i className="fa fa-wifi"></i> WebSense Hub</a>
            </div>
            <div className="navbar-collapse collapse">
              <ul className="nav navbar-nav">
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/sensors">Sensors</a></li>
              </ul>
              <ul className="nav navbar-nav navbar-right">
                <li className="dropdown">
                  <a href="#" className="dropdown-toggle" data-toggle="dropdown">
                    <i className="fa fa-cogs"></i> Settings <span className="caret"></span>
                  </a>
                  <ul className="dropdown-menu" role="menu">
                    <li><a href="/locations">Locations</a></li>
                    <li><a href="/database">Database</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      );
    }
  });

});
