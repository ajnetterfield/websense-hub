/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'], function($, Backbone, React) {

  return React.createClass({
    getInitialState: function() {
      return {
        title: '',
        sensor_id: '',
        location: ''
      };
    },
    handleChangeTitle: function(e) {
      this.setState({title: e.target.value});
    },
    handleChangeSensorId: function(e) {
      this.setState({sensor_id: e.target.value});
    },
    handleChangeLocation: function(e) {
      this.setState({location: e.target.value});
    },
    handleSubmit: function(e) {
      e.preventDefault();
      this.props.handleUpdate({rid: this.state.sensor_id, title: this.state.title, sensor_id: this.state.sensor_id, location: this.state.location});
      this.setState({title: '', sensor_id: '', location: ''});
      $('#sensor_modal').modal('hide');
    },
    render: function() {
      return (
        <form id="sensor_form">
          <label htmlFor="title">Name</label>
          <input id="title" name="title" type="text" className="form-control" value={this.state.title} onChange={this.handleChangeTitle} placeholder={"e.g. Bedroom 1 in-wall sensor"} required autofocus />
          <label htmlFor="id">Sensor ID</label>
          <input id="sensor_id" name="sensor_id" type="text" className="form-control" value={this.state.sensor_id} onChange={this.handleChangeSensorId} placeholder={"e.g. HOBO-174839454"} required />
          <label htmlFor="location">Location</label>
          <select id="location" name="location" className="form-control" value={this.state.location} onChange={this.handleChangeLocation} required>
            <option value />
            <option value>Kalgoorlie</option>
            <option value>Perth</option>
          </select>
        </form>
      );
    }
  });

});
