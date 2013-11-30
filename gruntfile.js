module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            beforeconcat: ['gruntfile.js', 'public/js/**/*.js'],
            afterconcat: ['public/dist/*.js']
        },
        jasmine: {
            src: ['scripts/js/**/*.js'],
            options: {
                keepRunner: true,
                specs: 'scripts/spec/**/*Spec.js'
            }
        },
        uglify: {
            options: {
                banner: '/* \n * <%= pkg.name %>\n * <%= grunt.template.today("yyyy-mm-dd") %>\n * Author: Kurtis Kemple\n * Email: kurtiskemple@gmail.com\n * URL: http://kurtiskemple.com\n */\n'
            },
            build: {
                src : [ 'scripts/js/**/*.js' ],
                dest : 'public/dist/smc.<%= pkg.version %>.min.js'
            }
        },
        watch: {
            js: {
                files: ['scripts/js/**/*.js', 'scripts/spec/**/*.js'],
                tasks: ['jshint', 'jasmine'],
                options: {
                    livereload: true
                }
            },
            less: {
                files: ['styles/less/**/.less'],
                tasks: [ 'less:development' ],
                options: {
                    livereload: true
                }
            },
            blade: {
                files: ['app/views/**/*.blade.php', '!app/views/emails/**/*.blade.php'],
                livereload: true
            }
        },
        less: {
          development: {
            files: [{
                  expand: true,
                  cwd: 'styles/less',
                  src: 'app.less',
                  dest: 'dist/css/app.css'
            }]
          },
          production: {
            options: {
              cleancss: true
            },
            files: [{
                  expand: true,
                  cwd: 'styles/less',
                  src: 'app.less',
                  dest: 'dist/css/app.css'
            }]
          }
        },
        phpunit: {
            classes: {
                dir: 'app/tests/'
            },
            options: {
                bin: 'vendor/bin/phpunit',
                bootstrap: 'bootstrap/autoload.php',
                colors: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-jasmine');
    grunt.loadNpmTasks('grunt-phpunit');
    //grunt.loadNpmTasks('grunt-contrib-concat');
    //grunt.loadNpmTasks('grunt-contrib-copy');
    //grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('default', ['less:development', 'jshint:beforeconcat', 'jasmine', 'phpunit']);
    grunt.registerTask('test', ['jshint:beforeconcat', 'jasmine', 'phpunit']);
    grunt.registerTask('production', ['less:production', 'jshint:beforeconcat', 'jasmine', 'uglify', 'jshint:afterconcat', 'phpunit']);
};