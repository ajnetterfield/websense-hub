/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'], function($, Backbone, React) {

  return React.createClass({
    handleOpenModal: function() {
      this.props.handleOpenModal('');
    },
    render: function() {
      return (
        <div>
          <button className="btn btn-success" data-toggle="modal" data-target="#sensor_modal" onClick={this.handleOpenModal}>Create</button>
        </div>
      );
    }
  });

});
