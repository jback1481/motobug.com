module.exports = function(grunt) {
  // -----------------------------------------
  // Start Grunt configuration
  // -----------------------------------------

  grunt.initConfig({

    // Load package.json file
    pkg: grunt.file.readJSON('package.json'),

    // --------------------------------------
    // watch Configuration
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
    // sass Configuration
    // --------------------------------------

    sass: {
      options: {
        loadPath: ['develop/scss/vendor']
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
    },

    // --------------------------------------
    // cssmin Configuration
    // --------------------------------------

    cssmin: {
      minify: {
        src: 'dist/assets/css/style.css',
        dest: 'css/style.min.css'
      }
    }
  });

  // -----------------------------------------
  // Load Grunt tasks
  // -----------------------------------------

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  // -----------------------------------------
  // Register Grunt tasks
  // -----------------------------------------

  grunt.registerTask('buildCSS', ['sass', 'cssmin']);
  grunt.registerTask('buildJS',  ['concat', 'uglify']);
  grunt.registerTask('default', ['buildCss']);
};