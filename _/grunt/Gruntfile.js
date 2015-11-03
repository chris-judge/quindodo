module.exports = function(grunt) {

	// All configuration goes here 
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		concat: {
			// Configuration for concatinating files goes here.
			dist: {
				src: [
					'../js/src/variables.js',
					'../js/src/functions.js',
					'../js/src/ready.js',
					'../js/src/scroll.js'
				],
				dest: '../js/pro/global.js',
			},
		},

		uglify: {
		    build: {
		        src: '../js/pro/global.js',
		        dest: '../js/pro/global.min.js',
		    },
		},


		imagemin: {
		    dynamic: {
		        files: [{
		            expand: true,
		            cwd: '../img/src/',
		            src: ['**/*.{png,jpg,gif}'],
		            dest: '../img/pro/'
		        }]
		    }
		},

		compass: {
			dev: {
		    	options: {              
		        	sassDir: '../sass',
		        	cssDir: '../css',
		        	fontsDir: '../fonts',
		        	imagesDir: '../img/pro',
		        	images: '../img/pro',
		        	javascriptsDir: '../js/pro',
		        	outputStyle: 'compressed',
		        	relativeAssets: false,
		        	httpPath: '.',
		        }
		    },
		},

		autoprefixer: {
	    	options: {
	    		browsers: ['last 2 versions', 'ie 9']
	    	},
	    	main: {
		        expand: true,
		        flatten: true,
		        src: ['../css/*.css', '!../css/*.min.css'],
		        dest: '../css/'
		    }
	 	 },

		cssmin: {
		  	// minify: {
		   //  	expand: true,
		   //  	cwd: '../css/',
		   //  	src: ['*.css', '!*.min.css'],
		   //  	dest: '../css/',
		   //  	ext: '.min.css'
		  	// }
			target: {
				files: {
					'../css/application.min.css': ['../css/*.css', '!../css/*.min.css']
				}
			}
		},

		watch: {
		    scripts: {
		        files: ['../js/**/**.js'],
		        tasks: ['concat', 'uglify'],
		        options: {
		            spawn: false,
		        },
		    },
		    images: {
		    	files: ['../img/src/**.{png,jpg,gif}'],
				tasks: ['imagemin'],
				options: {
					spawn: false,
				}
		    },
		    compass: {
		    	files: ['../**/*.{scss,sass}'],
		    	tasks: ['compass'],
		    },
		    svgstore: {
		    	files: ['../img/src/**.{svg}'],
				tasks: ['svgstore'],	    	
		    },
		    autoprefixer: {
		    	files: ['../css/*.css', '!../css/*.min.css'],
		    	tasks: ['autoprefixer'],
		    },
		    cssmin: {
		    	files: ['../css/*.css', '!../css/*.min.css'],
				tasks: ['cssmin'],
				options: {
					livereload: 35729
				}
		    },
			php: {
				files: ['../../*.php'],
				options: {
					livereload: 35729
				}
			}

		},

		svgstore: {
		    default: {
		    	files: {
					'../img/pro/svg-defs.svg': ['../img/src/svg/*.svg']
				}
		    }
		},


	});

	// Where we tell Grunt we plan to use this plug-in.
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-svgstore');

	// Where we tell Grunt what to do when we type "grunt" into the terminal.
	grunt.registerTask('default', ['concat', 'uglify', 'imagemin', 'svgstore', 'compass', 'watch']);

};
