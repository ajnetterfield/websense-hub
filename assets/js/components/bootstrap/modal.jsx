/** @jsx React.DOM */

define(['jquery', 'backbone', 'react'],
  function($, Backbone, React) {

  return React.createClass({
    render: function() {
      return (
        <div className="modal fade" id={this.props.id} tabIndex={-1} role="dialog" aria-labelledby={this.props.id + "_label"} aria-hidden="true">
          <div className="modal-dialog">
            <div className="modal-content">
              <div className="modal-header">
                <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 className="modal-title" id={this.props.id + "_label"}>{this.props.title}</h4>
              </div>
              <div className="modal-body">
                {this.props.children}
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
