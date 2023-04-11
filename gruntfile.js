
// const sass = require('node-sass');

module.exports = function(grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        watch: {
            js: {
                files: ['js/src/*.js'],
                tasks: ['uglify'],
                options: {
                    spawn: false
                }
            },
            css: {
                files: ['css/src/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false
                }
            }
        },


        // uglify to concat, minify, and make source maps
        uglify: {
            dist: {
                files: {
                    'js/main.js': [
                        'js/lib/magnific/dist/jquery.magnific-popup.min.js',
                        'js/lib/fitvids/jquery.fitvids.js',
                        'js/lib/jquery.query.js',
                        'js/src/*.js',
                    ]
                }
            }
        },


        // dictate where our sass files will compile to.
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/main.css': 'css/src/main.scss',
                }
            }
        },


        // we use the Sass
        /*
        sass: {
            options: {
                implementation: sass
            },
            dist: {
                files: {
                    'css/main.css': 'css/src/main.scss'
                }
            },
            sourceMapSimple: {
                options: {
                    sourceMap: true
                },
                files: {
                    'css/main.map.css': 'css/src/main.scss'
                }
            },        
        }
        */
        
    });

    // register task
    grunt.registerTask('default', ['watch']);

    // a build task just in case we want to
    grunt.registerTask('build', ['sass','uglify']);

};

