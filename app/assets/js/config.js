var require = {

  // Timeout for loading scripts
  waitSeconds: 15,

  paths: {

    // Libraries
    jquery: '../vendor/jquery/dist/jquery',
    'bootstrap': '../vendor/bootstrap/dist/js/bootstrap',
    'react': '../vendor/react/react',
    'backbone': '../vendor/backbone/backbone',
    'underscore': '../vendor/underscore/underscore',
    'highstock': '../vendor/highstock/highstock',

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

  }
};
