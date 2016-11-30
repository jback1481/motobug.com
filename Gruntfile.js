module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    concat: {
      options: {
        stripBanners: true
      },
      dist: {
        dest: 'js/dist/app.min.js',
        src: [
          'js/src/vendor/**/*.js',
          'js/src/**/*.js',
          'js/src/*.js'
        ]
      }
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      dist: {
        dest: 'dist/<%= pkg.name %>.min.js',
        src: '<%= concat.dist.dest %>'
      }
    },
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        globals: {}
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      lib_test: {
        src: ['lib/**/*.js', 'test/**/*.js']
      }
    },
    nodeunit: {
      files: ['test/**/*_test.js']
    },
    sass: {
      dev: {
        options: {
          sourcemap: 'none',
          style: 'expanded',
          loadPath: [
            'bower_components/foundation/scss/'
          ]
        },
        files: [{
            expand: true,
            cwd: 'css/',
            src: ['**/**/main.scss'],
            dest: 'css/src/css/',
            flatten: true,
            ext: '.css'
        }]
      },
      prod: {
        options: {
          sourcemap: 'none',
          style: 'compressed',
          loadPath: [
            'bower_components/foundation/scss'
          ]
        },
        files: [{
            expand: true,
            cwd: 'css/',
            src: ['**/**/main.scss'],
            dest: 'css/dist/',
            flatten: true,
            ext: '.css'
        }]
      }
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      },
      lib_test: {
        files: '<%= jshint.lib_test.src %>',
        tasks: ['jshint:lib_test', 'nodeunit']
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-nodeunit');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task.
  grunt.registerTask('default', ['concat']);
};
