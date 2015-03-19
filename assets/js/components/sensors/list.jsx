/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/bootstrap/panel', 'components/sensors/actions', 'components/sensors/table'],
  function($, Backbone, React, Panel, SensorActions, SensorTable) {

  return React.createClass({
    getInitialState: function() {
      return {
        sensors: []
      };
    },
    componentDidMount: function() {
      this.refresh();
    },
    refresh: function() {
      this.setState({"sensors": [{rid: "#12:1", title: "HOBO 123", sensor_id: "123"},{rid: "#12:2", title: "HOBO 234", sensor_id: "234"}]});
      // this.forceUpdate();
      // that = this;
      // $.ajax({
      //   type: "POST",
      //   url: "/api/v1.php",
      //   data: {
      //     attributes: ['@rid', 'title', 'sensor_id', 'location.title']
      //   }
      // })
      // .done(function(json_data) {
      //   var data = JSON.parse(json_data);
      //   that.setState({sensors: data});
      // });
    },
    // handleUpdate: function(data) {
    //   this.setState({sensors: data});
    // },
    render: function() {
      var actions = <SensorActions />;
      return (
        <Panel title="Sensors" table={true} actions={actions}>
          <SensorTable sensors={this.state.sensors} />
        </Panel>
      );
    }
  });

});
