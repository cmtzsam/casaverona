import browserSync    from 'browser-sync';
import gulp           from 'gulp';
import autoprefixer   from 'gulp-autoprefixer';
import cleanCSS       from 'gulp-clean-css';
import concat         from 'gulp-concat';
import gulpIf         from 'gulp-if';
import gulpSass from 'gulp-sass';
import sass from 'sass';

const sassCompiler = gulpSass(sass);

import sourcemaps     from 'gulp-sourcemaps';




// custom modules
import { paths, sync, settingsAutoprefixer, critical, criticalSrcPages } from './config.js' ;
import {scripts} from './assets/js/list_scripts.js' ;

const flags   = { production: false };


// Development Tasks 
// -----------------
// Start browserSync server
gulp.task( 'browserSync', callback => {
	browserSync.init( sync.server );
	callback();
});
// Sass convert
gulp.task( 'sass', () => {
	return gulp.src( paths.scss + '**/*.scss' )
			   .pipe( gulpIf( !flags.production, sourcemaps.init() ) )
			   .pipe( sassCompiler().on( 'error', sassCompiler.logError ) )
			   .pipe( autoprefixer( { browserslistrc: settingsAutoprefixer.browsers } ) )
			   .pipe( gulpIf( !flags.production, sourcemaps.write() ) )
			   .pipe( gulp.dest( paths.css ) )
			   .pipe( browserSync.reload( { stream: true } ) );
});
// concat all custom js
gulp.task( 'scripts', () => {
	return gulp.src( scripts )
			   .pipe( concat( 'starter.js' ) )
			   .pipe( gulp.dest( paths.scripts ) );
});
// Watchers
gulp.task( 'watch', done => {
	gulp.watch( paths.scss + '**/*.scss', gulp.series( 'sass' ) );
	gulp.watch( paths.scripts + 'modules/**/*.js', gulp.series( 'scripts' ) );
	gulp.watch( paths.html + '**/*.{php,tpl,html}', browserSync.reload );
	done();
});


// Production Tasks
// -----------------
// Minify css
gulp.task( 'minify', () => {
	return gulp.src( paths.css + '**/*.css' )
			   .pipe( cleanCSS( {level:{1:{specialComments:0}}}) )
			   .pipe( gulp.dest( paths.css ) );
});
// critical css
const eachSourcesCritical = ( index, array, callback ) => {
	if ( index < array ) {
		critical.generate({
			base: config.critical.base,
			inline: false,
			include: config.criticalSrcPages[index].include,
			ignore: config.critical.ignore,
			src: config.criticalSrcPages[index].url,
			css: config.critical.css,
			target: {
				css: config.criticalSrcPages[index].css,
			},
			penthouse: config.critical.penthouse,
			dimensions: config.critical.dimensions
		}).then( () => {
			eachSourcesCritical( index + 1, array );
		});
	} else {
		gulp.task( 'minify' )();
	}
}
gulp.task( 'critical', callback => {
	let indexEl = 0;
	const lengthCriticalSources = config.criticalSrcPages.length;
	eachSourcesCritical( indexEl, lengthCriticalSources );
	callback();
});



// development - local server - default task
gulp.task( 'default', gulp.series(
	'scripts',
	'sass',
	gulp.parallel(
		'browserSync',
		'watch'
	)
));

// production - remote server
gulp.task( 'production', callback => {
	flags.production = true;
	gulp.series(
		'scripts',
		'sass',
		'minify',
		'critical')();
	callback();
});