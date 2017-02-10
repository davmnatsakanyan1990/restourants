var gulp = require('gulp');
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');
var minify = require('gulp-minify');
var ngmin = require('gulp-ngmin');
var less = require('gulp-less');
var path = require('path');

gulp.task('compress', function() {
    gulp.src('js/*.js')
        .pipe(minify({
            ext:{
                src:'-debug.js',
                min:'.js'
            },
            exclude: ['tasks'],
            ignoreFiles: ['.combo.js', '-min.js']
        }))
        .pipe(gulp.dest('minjs'))
});

gulp.task('ng', function () {
    return gulp.src('ng/app.js')
        .pipe(ngmin({dynamic: true}))
        .pipe(gulp.dest('ngmini'));
});

gulp.task('less', function () {
    gulp.src('./styles/all.less')
        .pipe(less())
        .pipe(gulp.dest('./styles/'))
        .pipe(cssmin())
        .pipe(gulp.dest('./css'))

});

gulp.task('default', [ 'less' ]);