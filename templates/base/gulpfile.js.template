import gulp from 'gulp';
import { path } from './gulp/config/path.js';
import { plugins } from './gulp/config/plugins.js';
import { reset } from './gulp/tasks/reset.js';
import { scss } from './gulp/tasks/scss.js';
import { js } from './gulp/tasks/js.js';
import { images } from './gulp/tasks/images.js';
// import { svgSprive } from './gulp/tasks/svgSprite.js';
// import { fonts } from './gulp/tasks/fonts.js';

global.app = {
    isBuild: process.argv.includes('--build'),
    isDev: !process.argv.includes('--build'),
    path: path,
    gulp: gulp,
    plugins: plugins,
};

process.env.BROWSERSLIST_ENV = app.isDev ? 'development' : 'production';

function watcher() {
    gulp.watch(path.watch.php, scss);
    gulp.watch(path.watch.scss, scss);
    gulp.watch(path.watch.js, js);
    gulp.watch(path.watch.js, scss);
    gulp.watch(path.watch.images, images);
}

// export { svgSprive };

const mainTasks = gulp.parallel(
    scss,
    js,
    images,
    // fonts,
);

const dev = gulp.series(reset, mainTasks, gulp.parallel(watcher));
const build = gulp.series(reset, mainTasks);

export { dev };
export { build };

gulp.task('default', dev);
