/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar',
  'components/bootstrap/modal', 'components/bootstrap/panel',
  'components/sensors/form', 'components/sensors/list', 'components/sensors/actions'],
  function($, Backbone, React, Navbar, Modal, Panel, SensorForm, SensorList, SensorActions) {

  return React.createClass({
    getInitialState: function() {
      return {
        sensors: [],
        actions: '',
        modal_id: "sensor_modal",
        form_id: "sensor_form"
      };
    },
    componentWillMount: function() {
      console.log("componentWillMount");
      this.state.actions = <SensorActions handleOpenModal={this.handleOpenModal} />;
      this.state.sensors = new Sensors();
      this.state.sensors.on('add remove change', this.forceUpdate.bind(this, null));
      this.refresh();
    },
    refresh: function() {
      console.log("refresh");
      this.state.sensors.fetch();
    },
    handleSubmit: function(data) {
      var sensor = new Sensor(data);
      sensor.save();
      // this.state.sensors.add(sensor);
    },
    handleOpenModal: function(rid) {
      if (rid == '') {
        console.log("[AJ] new form");
        $("#" + this.state.form_id)[0].reset();
      } else {
        console.log("[AJ] edit form");
        sensor = this.state.sensors.findWhere({"@rid": rid})
        if (sensor) {
          $("#title").val(sensor.attributes.title);
          $("#sensor_id").val(sensor.attributes.sensor_id);
          $("#rid").val(sensor.attributes["@rid"]);
        } else {
          $("#" + this.state.form_id)[0].reset();
        }
      }
    },
    render: function() {
      console.log("render");
      return (
        <div className="sensors-index">
          <Navbar />
          <div className="main">
            <div className="container">
              <Panel title="Sensors" table={true} actions={this.state.actions}>
                <SensorList sensors={this.state.sensors} form_id={this.state.form_id} modal_id={this.state.modal_id} handleOpenModal={this.handleOpenModal} />
              </Panel>
            </div>
          </div>
          <Modal id={this.state.modal_id} title="Sensors" form_id={this.state.form_id}>
            <SensorForm id={this.state.form_id} handleSubmit={this.handleSubmit} />
          </Modal>
          <div className="react-alert"></div>
        </div>
      );
    }
  });

});
