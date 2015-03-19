/** @jsx React.DOM */

define(['jquery', 'react'], function($, React) {

  return React.createClass({
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
                <li><a href="/locations">Locations</a></li>
              </ul>
            </div>
          </div>
        </div>
      );
    }
  });

});
