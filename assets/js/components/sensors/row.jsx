/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/bootstrap/modal', 'components/sensors/form'], function($, Backbone, React, Modal, SensorForm) {

  return React.createClass({
    confirmDelete: function() {
      confirm("Are you sure you want to delete this item?");
    },
    render: function() {
      return (
        <tr>
          <td>{this.props.title}</td>
          <td className="hidden-xs">{this.props.sensor_id}</td>
          <td className="hidden-xs">{this.props.location}</td>
          <td className="row-actions">
            <button className="btn btn-default btn-become-danger" onClick={this.confirmDelete}><i className="fa fa-trash"></i></button>
            <button className="btn btn-success" data-toggle="modal" data-target="#sensor_modal"><i className="fa fa-pencil"></i></button>
          </td>
        </tr>
      );
    }
  });

});
