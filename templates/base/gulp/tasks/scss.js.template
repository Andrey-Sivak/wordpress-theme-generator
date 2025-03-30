import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import rename from 'gulp-rename';
import autoprefixer from 'autoprefixer';
import tailwindcss from '@tailwindcss/postcss';
import postcss from 'gulp-postcss';
import cssnano from 'cssnano';
import clone from 'gulp-clone';
import cache from 'gulp-cached';

const sass = gulpSass(dartSass);

export const scss = () => {
	return app.gulp
		.src(app.path.src.scss)
		.pipe(cache('scss'))
		.pipe(
			app.plugins.plumber(
				app.plugins.notify.onError({
					title: 'SCSS',
					message: 'Error: <%= error.message %>',
				}),
			),
		)
		.pipe(sass({ style: 'expanded' }))
		.pipe(postcss([tailwindcss(), autoprefixer({ grid: 'autoplace' })]))
		.pipe(clone())
		.pipe(postcss([cssnano({ preset: 'default' })]))
		.pipe(rename({ extname: '.min.css' }))
		.pipe(app.gulp.dest(app.path.build.css));
};
