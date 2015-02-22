'use strict';

module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

  grunt.loadNpmTasks('grunt-react');

  var jsFileList = [
    // 'assets/vendor/require/build/require.js',
    // 'assets/vendor/jquery/dist/jquery.js',
    // 'assets/vendor/underscore/underscore.js',
    // 'assets/vendor/backbone/backbone.js',
    // 'assets/vendor/handlebars/handlebars.js',
    // 'assets/vendor/react/react.js',
    // 'assets/vendor/bootstrap/dist/js/bootstrap.js',
    // 'assets/vendor/moment/moment.js',
    // 'assets/vendor/moment-timezone/moment-timezone.js',
    // 'assets/vendor/selectize/handlebars.js',
    // 'assets/vendor/highstock/highstock.js'
  ];

  grunt.initConfig({
    // jshint: {
    //   options: {
    //     jshintrc: '.jshintrc'
    //   },
    //   all: [
    //     'Gruntfile.js',
    //     'assets/js/*.js',
    //     '!assets/js/scripts.js',
    //     '!assets/**/*.min.*'
    //   ]
    // },
    less: {
      dev: {
        files: {
          'assets/css/main.css': [
            'assets/less/main.less'
          ]
        },
        options: {
          compress: false
        }
      },
      build: {
        files: {
          'assets/css/main.min.css': [
            'assets/less/main.less'
          ]
        },
        options: {
          compress: true
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        options: {
          map: {
            prev: 'assets/css/'
          }
        },
        src: 'assets/css/main.css'
      },
      build: {
        src: 'assets/css/main.min.css'
      }
    },
    // concat: {
    //   options: {
    //     separator: ';',
    //   },
    //   dist: {
    //     src: [jsFileList],
    //     dest: 'assets/js/scripts.js',
    //   },
    // },
    // uglify: {
    //   dist: {
    //     files: {
    //       'assets/js/scripts.min.js': [jsFileList]
    //     }
    //   }
    // },
    react: {
      files: {
        expand: true,
        cwd: 'assets/js/components',
        src: ['**/*.jsx'],
        dest: 'assets/js/components/_compiled',
        ext: '.js'
      }
    },
    watch: {
      less: {
        files: [
          'assets/less/*.less',
          'assets/less/**/*.less'
        ],
        tasks: ['less:dev', 'autoprefixer:dev']
      },
      // js: {
      //   files: [
      //     jsFileList,
      //     '<%= jshint.all %>'
      //   ],
      //   tasks: ['jshint', 'concat']
      // }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev'
  ]);
  grunt.registerTask('re', [
    'react'
  ]);
  grunt.registerTask('dev', [
    // 'jshint',
    'less:dev',
    // 'autoprefixer:dev',
    // 'concat'
  ]);
  grunt.registerTask('build', [
    // 'jshint',
    'less:build',
    'autoprefixer:build',
    // 'uglify'
  ]);
};
