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
        less: {
          development: {
            files: {
                'public/styles/css/app.css' : 'public/styles/less/app.less'
            }
          },
          production: {
            options: {
              cleancss: true
            },
            files: {
                'public/styles/css/app.css' : 'public/styles/less/app.less'
            }
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
        },
        watch: {
            options: {
                livereload: true,
                tasks: ['default']
            },
            js: {
                files: ['scripts/js/**/*.js', 'scripts/spec/**/*.js']
            },
            less: {
                files: ['styles/less/**/.less']
            },
            php: {
                files: ['app/views/**/*.php', '!app/views/emails/**/*.php']
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

    grunt.registerTask('default', ['less:development', 'jshint:beforeconcat', 'phpunit']);
    grunt.registerTask('test', ['jshint:beforeconcat', 'jasmine', 'phpunit']);
    grunt.registerTask('production', ['less:production', 'jshint:beforeconcat', 'jasmine', 'uglify', 'jshint:afterconcat', 'phpunit']);
};