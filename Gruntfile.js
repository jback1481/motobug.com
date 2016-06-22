(function () { 'use strict'; }());

module.exports = function(grunt) {
  // Read in the config file
  var globalConfig = grunt.file.readJSON('config.json');

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    jshint: {
      options: {
        globals: {
          jQuery: true,
          console: true,
          module: true
        }
      },
      files: [
        'gruntfile.js',
        'js/src/*.js',
        'js/src/vendor/*.js'
      ]
    },

    concat: {
      options: {

      },
      concatJS: {
        options: {
          // define a string to put between each file in the concatenated output
          separator: ';'
        },
        dist: {
          // the files to concatenate
          src: ['src/**/*.js'],
          // the location of the resulting JS file
          dest: 'dist/<%= pkg.name %>.js'
        }
      },
      concatCSS: {
        options: {
          // define a string to put between each file in the concatenated output
          separator: ';'
        },
        dist: {
          // the files to concatenate
          src: ['src/**/*.css'],
          // the location of the resulting JS file
          dest: 'dist/<%= pkg.name %>.css'
        }
      }
    },

    uglify: {
      options: {

      },
      uglifyJS: {
        options: {

        }
      },
      uglifyCSS: {
        options: {

        }
      }
    },
    
    compass: {
    },
    
    watch: {
    }

  });

  grunt.registerTask('default', ['jshint', 'concatJS', 'uglify', 'concatCSS', 'compass']);
};
