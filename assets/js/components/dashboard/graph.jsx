/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar', 'components/common/loading', 'components/bootstrap/panel'], function($, Backbone, React, Navbar, Loading, Panel) {

  return React.createClass({
    getInitialState: function() {
      return {
        loading: true
      };
    },
    componentDidMount: function() {

      var that = this;

      $.ajax({
        type: "POST",
        url: "/api/graph.php",
        data: {}
      })
      .done(function(json_data) {
        data = JSON.parse(json_data);
        that.setState({loading: false});
        that.render();
        $('#highstocks-container').highcharts('StockChart', {
          rangeSelector : {
            selected : 1
          },
          title : {
            text : 'BOM Temperature'
          },
          series : [{
            name : 'BOM',
            data : data,
            tooltip: {
              valueDecimals: 2
            }
          }]
        });
      });

    },
    render: function() {
      if (this.state.loading) {

        return (
          <div className="panel-table-empty">
            <Loading />
          </div>
        );

      } else {

        return (
          <div id="highstocks-container" className="highstocks-wrapper"></div>
        );

      }
    }
  });

});
