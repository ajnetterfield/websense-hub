/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar', 'components/bootstrap/panel', 'components/dashboard/graph'], function($, Backbone, React, Navbar, Panel, Graph) {

  return React.createClass({
    render: function() {
      return (
        <div className="dashboard-index">
          <Navbar />
          <div className="main">
            <div className="container">
              <Panel title="Dashboard" table={true}>
                <Graph />
              </Panel>
            </div>
          </div>
          <div className="react-alert"></div>
        </div>
      );
    }
  });

});
