module.exports=function(grunt){
	require('load-grunt-tasks')(grunt);
	grunt.initConfig({
		jshint: {
            all: ['*src/**/*.js', '!*src/**/*.min.js']
        },
		uglify:{
			options:{
				mangle:false
			},
			dist:{
				files:{
					//'app/webroot/js/app.min.js': ['node_modules/jquery/dist/jquery.min.js','node_modules/bootstrap-sass/assets/javascripts/bootstrap.js','src/public/*.js'],
					//'app/webroot/js/app.min.js': ['src/jquery.min.js','src/bootstrap.min.js','src/public/*.js'],
					'app/webroot/js/app.min.js': ['src/public/*.js'],
					'app/webroot/js/admin.min.js': ['src/jquery.min.js',"src/bundle.js"],
					'app/webroot/js/adminAdd.min.js':["src/admin/**/*js"]
				}
			}
		},
		sass: {
			dist: {
				options: {
					style: 'compressed',
					compass:true,
					// sourcemap: 'none',
					//style: 'expanded',
      				require: 'susy'
				},
				files: [{ // C'est ici que l'on définit le dossier que l'on souhaite importer
				"expand": true,
				"cwd": "app/webroot/sass",
				"src": ["*.scss"],
				"dest": "app/webroot/css",
				"ext": ".min.css"
			}]
		}
	},
	fontello:{
		options:{
			scss:true,
			force:true
		},
		// dist:{
		// 	options:{
		// 		config : 'vendors/fonts/fontello/config.json',
		// 		fonts  : 'app/webroot/fonts/fontello/',
		// 		styles : 'app/webroot/sass/fontello/'
		// 	}
		// },
		dist:{
			options:{
				config : 'vendors/fonts/public/fontello/config.json',
				fonts  : 'app/webroot/fonts/public/fontello/',
				styles : 'app/webroot/sass/public/fonts/fontello/'
			}
		},
	},
	watch:{
      scripts: {
        files: '*src/**/*.js', // tous les fichiers JavaScript de n'importe quel dossier
        tasks: ['uglify:dist']
      },
		styles:{
			files:'**/*.scss',
			tasks:['sass:dist']
		}
	}

});
	grunt.registerTask('default',['sass:dist',"uglify:dist"])
}
