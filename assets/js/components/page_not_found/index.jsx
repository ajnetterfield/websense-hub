/** @jsx React.DOM */

define(['jquery', 'react', 'components/common/navbar'], function($, React, Navbar) {

  return React.createClass({
    render: function() {
      return (
        <div className="page-not-found cover-wrapper">
          <Navbar />
          <div className="cover">
            <div className="cover-inner">
              <span className="fa-stack fa-lg" style={{fontSize: '100px'}}>
                <i className="fa fa-file fa-stack-1x" style={{fontSize: '90px'}}></i>
                <i className="fa fa-ban fa-stack-2x text-primary"></i>
              </span>
              <h2>Page Not Found</h2>
            </div>
          </div>
        </div>
      );
    }
  });

});
