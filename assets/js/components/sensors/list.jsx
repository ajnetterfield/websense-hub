/** @jsx React.DOM */

define(['jquery', 'backbone', 'react','components/common/loading', 'components/sensors/list-item'],
  function($, Backbone, React, Loading, ListItem) {

  return React.createClass({
    render: function() {

      if (this.props.sensors.length == 0) {

        return (
          <Loading />
        );

      } else {

        listItems = this.props.sensors.map(function(sensor) {
          return <ListItem key={sensor.id} id={sensor.id} sensor={sensor} form_id={this.props.form_id} modal_id={this.props.modal_id} handleOpenModal={this.props.handleOpenModal} />
        }.bind(this));

        return (
          <ul className="list-group">
            {listItems}
          </ul>
        );

      }
    }
  });

});
