/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'],
  function($, Backbone, React) {

  return React.createClass({
    handleDelete: function() {
      if (confirm("Are you sure?")) {
        this.props.sensor.destroy();
      }
    },
    handleOpenModal: function() {
      this.props.handleOpenModal(this.props.id);
    },
    render: function() {

      // var attribute_pairs = _.pairs(this.props.sensor.attributes);

      attributes = _.map(this.props.sensor.attributes, function(val, key) {
        if (key == "title") {
          return (<h2>{val}</h2>);
        } else if (key != "@rid") {
          return (
            <p>
              {key + ": " + val}
            </p>
          );
        }
      });

      return (
        <li className="list-group-item">
          <button className="btn btn-danger btn-sm pull-right" onClick={this.handleDelete}>Delete</button>
          <button className="btn btn-default btn-sm pull-right" data-toggle="modal" data-target={"#" + this.props.modal_id} onClick={this.handleOpenModal}>Edit</button>
          {attributes}
        </li>
      );
    }
  });

});
