/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar', 'components/common/loading', 'components/bootstrap/panel'], function($, Backbone, React, Navbar, Loading, Panel) {

  return React.createClass({
    getInitialState: function() {
      return {
        loading: true,
        series: []
      };
    },
    componentDidMount: function() {
      var that = this;
      var seriesCounter = 0;
      $.ajax({
        type: "GET",
        url: "/api/v1.php",
        data: {}
      })
      .done(function(data) {
        console.log("Received Data");
        that.setState({loading: false});
        var series = [];
        $.each(data, function (i, d) {
          series[i] = {
            name: "Graph " + i,
            data: d
          };
        });
        that.setState({"series": series});
        that.updateChart();
      });
    },
    updateChart: function () {
      console.log("Rendering Chart");
      var that = this;
      $('#highstocks-container').highcharts('StockChart', {
        rangeSelector: {
          selected: 4
        },
        yAxis: {
          labels: {
            formatter: function () {
              return (this.value > 0 ? ' + ' : '') + this.value + '%';
            }
          },
          plotLines: [{
            value: 0,
            width: 2,
            color: 'silver'
          }]
        },
        plotOptions: {
          series: {
            compare: 'percent'
          }
        },
        tooltip: {
          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
          valueDecimals: 2
        },
        title: "BOM Temperature",
        series: that.state.series
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
