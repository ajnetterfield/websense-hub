/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'exports'], function($, Backbone, React, exports) {

  return React.createClass({
    getInitialState: function() {
      return {};
    },
    componentDidMount: function() {

    },
    componentWillUnmount: function() {

    },
    render: function() {
      return (
        <div className="modal fade" id="sensor_modal" tabindex={-1} role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div className="modal-dialog">
            <div className="modal-content">
              <div className="modal-header">
                <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 className="modal-title" id="myModalLabel">Sensor</h4>
              </div>
              <div className="modal-body">
                <label htmlFor="name">Name</label>
                <input id="name" name="name" type="text" className="form-control" defaultValue placeholder="e.g. Bedroom 1 in-wall sensor" required autofocus />
                <label htmlFor="id">ID</label>
                <input id="id" name="id" type="text" className="form-control" defaultValue placeholder="e.g. HOBO-174839454" required />
                <label htmlFor="location">Location</label>
                <select id="location" name="location" className="form-control" required>
                  <option value />
                  <option value>Kalgoorlie</option>
                  <option value>Perth</option>
                </select>
              </div>
              <div className="modal-footer">
                <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" className="btn btn-success">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      );
    }
  });

});
