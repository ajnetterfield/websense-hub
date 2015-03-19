/** @jsx React.DOM */

define(['jquery', 'react'], function($, React) {

  return React.createClass({
    getDefaultProps: function() {
      return {
        title: '',
        actions: '',
        table: false
      };
    },
    render: function() {
      return (
        <div className='panel panel-default'>
          <div className='panel-heading'>
            <div className="panel-actions">
              {this.props.actions}
            </div>
            <h3 className='panel-title'>{this.props.title}</h3>
          </div>
          <div className={this.props.table ? 'panel-table' : 'panel-body'}>
            {this.props.children}
          </div>
        </div>
      );
    }
  });

});
