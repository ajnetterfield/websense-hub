/** @jsx React.DOM */

define(['jquery', 'backbone', 'react', 'components/common/navbar',
    'models/sensor', 'collections/sensors',
    'models/measurement', 'collections/measurements'
  ], function($, Backbone, React, Navbar) {

  return React.createClass({
    componentDidMount: function() {

      // Models
      ////////////////////////////

      // var sensor1 = new Sensor({id: "#14:1", title: 'Snsr 1', sensor_id: 1});
      // var sensor2 = new Sensor({id: "#14:2", title: 'Sensor 2', sensor_id: 2});
      // var sensor3 = new Sensor({id: "#14:3", title: 'Sensor 3', sensor_id: 3});

      // sensor1.save();

      // Model Setters
      // sensor1.set({title: 'Sensor 1'}, {validate: true});
      // sensor1.set({title: 'Sensor 1'});

      // Model Getters
      // sensor.get('title');
      // sensor.toJSON();

      // Collections
      ////////////////////////////

      // var sensors = new Sensors();

      // Collection Setters
      // sensors.add(sensor1);
      // sensors.remove(sensor1);
      // sensors.reset([sensor1, sensor2]);
      // sensors.push(sensor3);
      // sensors.pop();
      // sensors.unshift(sensor3);
      // sensors.sort();

      // Collection Getters
      // sensors.getByCid('c0');
      // sensors.at(0);
      // sensors.pluck('title');
      // sensors.where({title: 'Sensor 1'});
      // sensors.models;
      // console.log(sensors.toJSON());

    },
    render: function() {
      return (
        <div className="home-index cover-wrapper">
          <Navbar />
          <div className="cover">
            <div className="cover-inner home">
              <i className="fa fa-wifi" style={{fontSize: '300px', color: '#fff'}}></i>
              <div style={{color: '#fff'}}>
                <h1 style={{fontSize: '32px', margin: '0 0 20px 0'}}>WebSense Hub</h1>
                <p style={{fontSize: '18px'}}>Simple consolidation of sensor data.</p>
              </div>
            </div>
          </div>
        </div>
      );
    }
  });

});
