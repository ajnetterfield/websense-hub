var require = {

  // Timeout for loading scripts
  waitSeconds: 15,

  paths: {

    // Libraries
    'jquery': 'lib/jquery/jquery',
    'bootstrap': 'lib/bootstrap/bootstrap',
    'react': 'lib/react/react',
    'underscore': 'lib/underscore/underscore',
    'backbone': 'lib/backbone/backbone',
    'highstock': 'lib/highstock/highstock',

    // Backbone
    'main': 'main',
    'router': 'router',

    // React Components
    'components/common/navbar': 'components/_compiled/common/navbar',
    'components/home/index': 'components/_compiled/home/index',
    'components/sensors/index': 'components/_compiled/sensors/index',
    'components/dashboard/index': 'components/_compiled/dashboard/index',
  },
  map: {

  },
  shim: {
    'bootstrap' : { 'deps' :['jquery'] }
  }
};
