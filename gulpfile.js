var gulp = require ('gulp');
    // uglify = require('gulp-uglify');
    sourceName = 'ip';
    pug = require ('gulp-pug');
    stylus = require ('gulp-stylus');
    csso = require('gulp-csso');
    csscomb = require('gulp-csscomb');
    nib = require('nib');
    del = require('del');
    spritesmith = require('gulp.spritesmith');
    htmlPrettify = require('gulp-prettify');
    rename = require('gulp-rename');
    runSequence = require('run-sequence');
    gulpZip = require('gulp-zip');
    browserSync = require('browser-sync').create();
    watch = require ('gulp-watch');
    concat = require('gulp-concat');
    gcmq = require('gulp-combine-mq');
    include = require('gulp-include');
    newer = require('gulp-newer');
    pugInheritance = require('gulp-pug-inheritance');
    changed = require('gulp-changed');
    gulpif = require('gulp-if');
    cached = require('gulp-cached');
    filter = require('gulp-filter');
    reload = browserSync.reload;


// Options
var options = {
    htmlPrettify: {
        'unformatted': ['pre', 'code'],
        'indent_with_tabs': false,
        'preserve_newlines': false,
        'brace_style': 'expand',
        'end_with_newline': false
    },
    browserSync: {
        server: {
            baseDir: './dist/'
        },
        notify: false,
        reloadOnRestart: false
    },
    gulpCached: {
        pug: 'pug/**/*.pug'
    },
    gulpNewer: {
        stylus: 'stylus/**/*.styl'
    }
};


// Browser sync 
gulp.task('browser-sync',['stylus', 'pug'], function(){
    browserSync.init(options.browserSync);
})
// gulp.task('bs-reload', function(cb) {
//     browserSync.reload();
// });


// Sprite generator
gulp.task('sprite', function() {
    var spriteData = 
        gulp.src('assets/images/sprite/*.png') 
        .pipe(spritesmith({
            imgName: 'sprite.png',
            cssName: '_sprite.styl',
            cssFormat: 'stylus',
            algorithm: 'binary-tree',
            padding: 10,
            cssTemplate: 'stylus-single.template.mustache',
            cssVarMap: function(sprite) {
                sprite.name = 'sprite-' + sprite.name;
            }
        }));
    spriteData.img.pipe(gulp.dest('dist/images/')); 
    spriteData.css.pipe(gulp.dest('stylus/components/')); 
});


// Retina sprite
gulp.task('retinaSprite', function() {
    var spriteData = 
        gulp.src('assets/images/retinaSprite/*.png') 
        .pipe(spritesmith({
            retinaSrcFilter: 'assets/images/retinaSprite/*2x.png',
            imgName: 'retinaSprite.png',
            retinaImgName: 'retinaSprite2x.png',
            cssName: '_retinaSprite.styl',
            cssFormat: 'stylus',
            algorithm: 'binary-tree',
            padding: 10,
            cssTemplate: 'stylus-retina.template.mustache',
            cssVarMap: function(sprite) {
                sprite.name = 'sprite-' + sprite.name;
            }
        }));
    spriteData.img.pipe(gulp.dest('dist/images/')); 
    spriteData.css.pipe(gulp.dest('stylus/components/')); 
});


// Pug task
gulp.task('pug', function buildHTML(cb) {
    return gulp.src(options.gulpCached.pug)
    .pipe(changed('./dist/', {extension: 'html'}))
    .pipe(gulpif(global.isWatching, cached('pug'), pugInheritance({basedir: 'pug', extension: '.pug' /*, skip: 'node_modules'*/})))
    .pipe(filter(function (file) {
        return !/\/_/.test(file.path) && !/^_/.test(file.relative);
    }))
    .pipe(pug())
    .pipe(htmlPrettify(options.htmlPrettify))
    .pipe(gulp.dest('./dist/'))
    .pipe(browserSync.reload({stream:true}));
});


// Stylus task
gulp.task('stylus', function (cb) {
    return gulp.src(['*.styl', '!_*.styl'], {cwd: 'stylus'})
        .pipe(newer(options.gulpNewer.stylus))
        .pipe(stylus({
            use: nib()
        }))
        .pipe(gcmq({beautify: true}))
        .pipe(csscomb())
        .pipe(gulp.dest('dist/css'))
        .pipe(csso())
        .pipe(browserSync.stream())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('dist/css'));
});
// gulp.task('stylus', function(cb){
//     return gulp.src(['*.styl', '!_*.styl'], {cwd: 'stylus'})
//     .pipe(stylus({
//         use: nib()
//     }))
//     .pipe(gcmq({beautify: true}))
//     .pipe(csscomb())
//     .pipe(gulp.dest('dist/css'))
//     .pipe(csso())
//     .pipe(rename({suffix: '.min'}))
//     .pipe(browserSync.stream())
//     .pipe(gulp.dest('dist/css'));
// });


var correctNumber = function correctNumber(number) {
    return number < 10 ? '0' + number : number;
};


// Return timestamp
var getDateTime = function getDateTime() {
    var now = new Date();
    var weekDays = new Array(7);
    weekDays[0] = "Sunday";
    weekDays[1] = "Monday";
    weekDays[2] = "Tuesday";
    weekDays[3] = "Wednesday";
    weekDays[4] = "Thursday";
    weekDays[5] = "Friday";
    weekDays[6] = "Saturday";
    var dayName = weekDays[now.getDay()];
    var year = now.getFullYear();
    var month = correctNumber(now.getMonth() + 1);
    var day = correctNumber(now.getDate());
    var hours = correctNumber(now.getHours());
    var minutes = correctNumber(now.getMinutes());
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + '-' + minutes + ' ' + ampm;
    return dayName + ' [' + year + '-' + month + '-' + day + '] - ' +  '[Time ' + strTime + ']';
};


// Build zip
gulp.task('build-zip', function() {
    var datetime = ' - ' + getDateTime();
    //var datetime = '-' + new Date();
    var zipName = sourceName + datetime + '.zip';

    return gulp.src('dist/**/*')
    .pipe(gulpZip(zipName))
    .pipe(gulp.dest('zip'));
});


// Del task
gulp.task('del', function (cb) {
    return del(['dist/footer.html', 'dist/mixins.html', 'dist/scripts.html', 'dist/layout.html', 'dist/variables.html', 'dist/head.html']);
});


// Zip task
gulp.task('zip', function (cb) {
    return runSequence(
        'build',
        'del',
        'build-zip',
        cb
    );
});


// Buid task
gulp.task('build', function (cb) {
    return runSequence(
        'build-js',
        'pug',
        'sprite',
        'retinaSprite',
        'stylus',
        cb
    );
});


// Js combine
gulp.task('combine-modules-scripts', function (cb) {
    return gulp.src(['*.js'], {cwd: 'js/plugins'})
        .pipe(concat('plugins.js', { newLine: '\n\n' }))
        .pipe(gulp.dest('dist/js/plugins/'));
});


gulp.task('combine-scripts', function (cb) {
    return gulp.src(['*.js'], {cwd: 'js'})
        .pipe(include())
        .pipe(gulp.dest('dist/js'));
    // .pipe(uglify())
    // .pipe(rename({suffix: '.min'}))
    // .pipe(gulp.dest('dist/js'));
});


gulp.task('build-js', function (cb) {
    return runSequence(
        'combine-modules-scripts',
        'combine-scripts',
        cb
    );
});


// Glup Development task
gulp.task('watch',function(){
    global.isWatching = true;


    // Modules pug
    watch(options.gulpCached.pug, function() {
        return runSequence(['pug'], browserSync.reload);
    });


    // Modules stylus
    watch(options.gulpNewer.stylus, function() {
        return runSequence('stylus');
    });


    // Modules retinaSprite
    watch('assets/images/retinaSprite/*.*', function() {
        return runSequence('retinaSprite', browserSync.reload);
    });


    // Modules sprite
    watch('assets/images/sprite/*.*', function() {
        return runSequence('sprite', browserSync.reload);
    });


    // Modules scripts
    watch('js/**/*.js', function() {
        return runSequence('build-js', browserSync.reload);
    });
});


gulp.task('default',['watch','browser-sync','pug', 'sprite', 'retinaSprite', 'stylus', 'build-js']);
