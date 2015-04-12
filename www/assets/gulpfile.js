/*--------------------------*\
    Gulp 构建脚本
\*--------------------------*/
var gulp = require("gulp");
var plugins = require("gulp-load-plugins")();
var buildPath = "./build";
var srcPath = "./src";

// HTML处理
gulp.task('build-html',function(){
  gulp.src(srcPath + "/static/**/*.html")
        .pipe(plugins.htmlmin())
        .pipe(gulp.dest(buildPath + '/static'));
});

// 图片处理
gulp.task('build-images',function(){
  gulp.src(srcPath + "/images/**/*")
        .pipe(plugins.imagemin())
        .pipe(gulp.dest(buildPath + '/images'));
});

// css 处理
gulp.task("build-css", function () {
    gulp.src(srcPath + "/css/**/*.css")
        .pipe(plugins.minifyCss({compatibility: "ie7"}))
        // .pipe(plugins.rename(function (path) {
        //     path.basename += ".min";
        // }))
        .pipe(gulp.dest(buildPath + "/css"));
});

// ui-dialog-css 处理
gulp.task("ui-dialog-css", function () {
    gulp.src(srcPath + "/modules/**/*.css")
        .pipe(plugins.minifyCss({compatibility: "ie7"}))
        // .pipe(plugins.rename(function (path) {
        //     path.basename += ".min";
        // }))
        .pipe(gulp.dest(buildPath + "/modules"));
});

// JavaScript module
gulp.task("js-module", function () {
    gulp.src(srcPath + "/modules/**/*.js")
        .pipe(plugins.uglify({mangle:false})) //{mangle:false} 不压缩变量名称
        // .pipe(plugins.rename(function (path) {
        //     path.basename += ".min";
        // }))
        .pipe(gulp.dest(buildPath + "/modules"));
});

// JavaScript lib
gulp.task("js-lib", function () {
    gulp.src(srcPath + "/lib/**/*.js")
        .pipe(plugins.uglify()) //{mangle:false} 不压缩变量名称
        // .pipe(plugins.rename(function (path) {
        //     path.basename += ".min";
        // }))
        .pipe(gulp.dest(buildPath + "/lib"));
});

// build html
gulp.watch(srcPath + "/static/**/*.html", ["build-html"]);

// build images
gulp.watch(srcPath + "/images/**/*", ["build-images"]);

// build css
gulp.watch(srcPath + "/css/**/*", ["build-css"]);

// ui dialog css
gulp.watch(srcPath + "/modules/**/*.css", ["ui-dialog-css"]);

// JavaScript module
gulp.watch(srcPath + "/modules/**/*.js", ["js-module"]);

// JavaScript lib
gulp.watch(srcPath + "/lib/**/*.js", ["js-lib"]);

// gulp命令默认启动
gulp.task("default", ["build-html","build-images","build-css","ui-dialog-css","js-module","js-lib"]);