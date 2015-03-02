/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/bootstrap/modal', 'components/sensors/form'], function($, Backbone, React, Modal, SensorForm) {

  return React.createClass({
    render: function() {
      return (
        <div>
          <button className="btn btn-success" data-toggle="modal" data-target="#sensor_modal">Create</button>
          <Modal id="sensor_modal" title="Sensors">
            <SensorForm />
          </Modal>
        </div>
      );
    }
  });

});
