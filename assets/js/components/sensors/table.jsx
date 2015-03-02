/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/loading', 'components/sensors/row'],
  function($, Backbone, React, Loading, Row) {

  return React.createClass({
    getInitialState: function() {
      return {
        sensors: [],
        rows: []
      };
    },
    render: function() {
      if (this.props.sensors.length == 0) {

        return (
          <div className="panel-table-empty">
            <Loading />
          </div>
        );

      } else {

        this.state.rows = this.props.sensors.map(function(sensor) {
          return <Row key={sensor.rid} title={sensor.title} sensor_id={sensor.sensor_id} location={sensor.location} />
        });

        return (
          <table className="table">
            <thead>
              <tr>
                <th>Title</th>
                <th className="hidden-xs">Sensor ID</th>
                <th className="hidden-xs">Location</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {this.state.rows}
            </tbody>
          </table>
        );
      }
    }
  });

});
