module.exports = function(grunt) {
  // -----------------------------------------
  // Start Grunt configuration
  // -----------------------------------------

  grunt.initConfig({

    // Load package.json file
    pkg: grunt.file.readJSON('package.json'),

    // --------------------------------------
    // Watch Configuration
    // --------------------------------------

    watch: {
      grunt: {
        files: ['Gruntfile.js'],
        tasks: ['default']
      },

      sass: {
        files: 'develop/scss/**/*.scss',
        tasks: ['buildCss']
      }
    },

    // --------------------------------------
    // Sass Configuration
    // --------------------------------------

    sass: {
      options: {
        loadPath: ['bower_components/foundation/scss']
      },
      dist: {
        options: {
          sourcemap: 'none',
          style:     'nested'
        },
        files: [{
          expand: true,
          cwd:    'develop/scss',
          src:    ['*.scss'],
          dest:   'dist/assets/css',
          ext:    '.css'
        }]
      }
    }
  });

  // -----------------------------------------
  // Load Grunt tasks
  // -----------------------------------------

  grunt.loadNpmTasks('grunt-contrib-sass');

  // -----------------------------------------
  // Register Grunt tasks
  // -----------------------------------------

  grunt.registerTask('buildCss', ['sass']);
  grunt.registerTask('watch', ['buildCss', 'watch']);
  grunt.registerTask('default', ['buildCss']);
};