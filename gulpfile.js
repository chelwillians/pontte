"use strict"

const gulp = require("gulp")
const sass = require("gulp-sass")(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const pxToRem = require('gulp-pxtorem')
const rename = require("gulp-rename")
const concat = require('gulp-concat')
const uglify = require('gulp-uglify-es').default
const autoprefixer = require('gulp-autoprefixer' );

const buildSass = () => gulp.src('./src/sass/styles.scss')
  .pipe(sourcemaps.init())
  .pipe(pxToRem())
  .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
  .pipe(rename({ basename: 'styles.min' }))
  .pipe(autoprefixer())
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./dist/css'))

const watchSass = () => gulp.watch('./src/sass/**/*.scss', buildSass)

const buildJs = () => gulp.src('./src/js/**/*.js')
  .pipe(sourcemaps.init())
  .pipe(concat('main.js'))
  .pipe(uglify())
  .pipe(rename({ basename: 'main.min' }))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./dist/js'));

const watchJs = () => gulp.watch('./src/js/**/*.js', buildJs)

const watch = async () => {
  await watchJs()
  await watchSass()
}

gulp.task('sass', buildSass)
gulp.task('js', buildJs)
gulp.task('default', watch)
