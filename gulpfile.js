/**
 * Created by guy on 25/07/17.
 */
let gulp = require('gulp'),
	connect = require('gulp-connect-php');

let server = new connect();

gulp.task('connect', function() {
	server.server();
});
gulp.task('disconnect', function() {
	server.closeServer();
});

gulp.task('default', ['connect', 'disconnect']);