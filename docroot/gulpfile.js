var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function() {
    gulp.src('sites/all/themes/vuz/css/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('sites/all/themes/vuz/css/'));
});

//Watch task
gulp.task('default',function() {
    gulp.watch('sites/all/themes/vuz/css/**/*.scss',['styles']);
});