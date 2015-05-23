/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'], function($, Backbone, React) {

  return React.createClass({
    getInitialState: function() {
      return {
        title: '',
        sensor_id: '',
        rid: ''
      };
    },
    handleChangeTitle: function(e) {
      this.setState({title: e.target.value});
    },
    handleChangeSensorId: function(e) {
      this.setState({sensor_id: e.target.value});
    },
    handleSubmit: function(e) {
      e.preventDefault();
      var data = {title: this.state.title, sensor_id: this.state.sensor_id};
      if (this.state.rid != '') {
        data.rid = this.state.rid;
      }
      this.props.handleSubmit(data);
      this.setState({title: '', sensor_id: '', rid: ''});
      $('#sensor_modal').modal('hide');
    },
    render: function() {
      return (
        <form id={this.props.id} onSubmit={this.handleSubmit}>
          <label htmlFor="title">Name</label>
          <input id="title" name="title" type="text" className="form-control" value={this.state.title} onChange={this.handleChangeTitle} placeholder={"e.g. Bedroom 1 in-wall sensor"} required autofocus />
          <label htmlFor="id">Sensor ID</label>
          <input id="sensor_id" name="sensor_id" type="text" className="form-control" value={this.state.sensor_id} onChange={this.handleChangeSensorId} placeholder={"e.g. HOBO-174839454"} required />
          <input id="rid" name="rid" type="hidden" value={this.state.rid} />
        </form>
      );
    }
  });

});
