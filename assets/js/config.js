var require = {

  // Timeout for loading scripts
  waitSeconds: 15,

  paths: {

    /* Libraries
    /**************************************************************************/

    'jquery': 'lib/jquery/jquery',
    'bootstrap': 'lib/bootstrap/bootstrap',
    'react': 'lib/react/react',
    'underscore': 'lib/underscore/underscore',
    'backbone': 'lib/backbone/backbone',
    'highstock': 'lib/highstock/highstock',

    /* Backbone
    /**************************************************************************/

    'main': 'main',
    'router': 'router',

    /* React Components
    /**************************************************************************/

    // Common
    'components/common/navbar': 'components/_compiled/common/navbar',
    'components/common/loading': 'components/_compiled/common/loading',
    'components/common/page_not_found': 'components/_compiled/common/page_not_found',

    // Bootstrap
    'components/bootstrap/panel': 'components/_compiled/bootstrap/panel',
    'components/bootstrap/modal': 'components/_compiled/bootstrap/modal',

    // Home Page
    'components/home/index': 'components/_compiled/home/index',

    // Dashboard
    'components/dashboard/index': 'components/_compiled/dashboard/index',
    'components/dashboard/graph': 'components/_compiled/dashboard/graph',

    // Sensors
    'components/sensors/index': 'components/_compiled/sensors/index',
    'components/sensors/list': 'components/_compiled/sensors/list',
    'components/sensors/form': 'components/_compiled/sensors/form',
    'components/sensors/actions': 'components/_compiled/sensors/actions',
    'components/sensors/table': 'components/_compiled/sensors/table',
    'components/sensors/row': 'components/_compiled/sensors/row',

    // Locations
    'components/locations/index': 'components/_compiled/locations/index',
  },
  map: {
    'bootstrap': {
      'jquery': 'jquery'
    }
  },
  shim: {
    'bootstrap': {
      deps: ['jquery']
    }
  }
};
