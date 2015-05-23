/** @jsx React.DOM */

define(['jquery', 'backbone', 'react',
  'components/common/navbar',
  'components/common/loading',
  'components/bootstrap/panel'],
  function($, Backbone, React, Navbar, Loading, Panel) {

  return React.createClass({
    getInitialState: function() {
      return {
        loading: true,
        measurements: [],
        series: []
      };
    },
    componentDidMount: function() {
      console.log("component did mount");
      console.log(this.state.series);
      if (this.state.series != []) {
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
      }
    },
    componentWillMount: function() {
      console.log("componentWillMount");
      this.state.measurements = new Measurements();
      // this.state.measurements.on('add remove change', this.forceUpdate.bind(this, null));
      this.refresh();
    },
    refresh: function () {
      console.log("refresh");

      this.state.measurements.fetch();

      var series = [
        {
          name: "Graph",
          data: [
            [1147651200000,67.79],
            [1147737600000,64.98],
            [1147824000000,65.26],
            [1147910400000,63.18],
            [1147996800000,64.51],
            [1148256000000,63.38],
            [1148342400000,63.15],
            [1148428800000,63.34],
            [1148515200000,64.33],
            [1148601600000,63.55],
            [1148947200000,61.22],
            [1149033600000,59.77]
          ]
        }
      ];

      this.setState({series: series, loading: false});

      // _.each(data, function (d) {
      //   series[0] = {
      //     name: "Graph",
      //     data: d
      //   };
      // });
      // that.setState({"series": series});

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
