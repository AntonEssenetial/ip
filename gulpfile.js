// npm i gulpjs/gulp#4.0 gulp-if gulp-pug emitty
var gulp = require('gulp'),
    sourceName = 'Project Name',
    $ = require('gulp-load-plugins')(),
    fs = require('fs'),
    path = require('path'),
    emitty = require('emitty').setup('source', 'pug'),
    pug = require ('gulp-pug'),
    stylus = require ('gulp-stylus'),
    csso = require('gulp-csso'),
    csscomb = require('gulp-csscomb'),
    nib = require('nib'),
    spritesmith = require('gulp.spritesmith'),
    htmlPrettify = require('gulp-prettify'),
    rename = require('gulp-rename'),
    gulpZip = require('gulp-zip'),
    browserSync = require('browser-sync').create(),
    watch = require ('gulp-watch'),
    concat = require('gulp-concat'),
    gcmq = require('gulp-combine-mq'),
    include = require('gulp-include'),
    changed = require('gulp-changed'),
    gulpif = require('gulp-if'),
    filter = require('gulp-filter'),
    imagemin = require('gulp-imagemin'),
    imageminPngquant = require('imagemin-pngquant'),
    buffer = require('vinyl-buffer'),
    reload = browserSync.reload;


// Read json and return object
function getJsonData(file) {
    var fs = require('fs');
    var path = require('path');

    return JSON.parse(
            fs.readFileSync(
                path.join(__dirname, file),
                'utf8'
            )
        );
}


// Error handler for gulp-plumber
function errorHandler(err) {
    $.util.log([ (err.name + ' in ' + err.plugin).bold.red, '', err.message, '' ].join('\n'));

    this.emit('end');
}


function correctNumber(number) {
    return number < 10 ? '0' + number : number;
}


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


// Options
var options = {

    htmlPrettify: {
        'unformatted': ['pre', 'code'],
        'indent_with_tabs': false,
        'preserve_newlines': false,
        'brace_style': 'expand',
        'end_with_newline': false
    },

    plumber: {
        errorHandler: errorHandler
    },

    browserSync: {
        server: {
            baseDir: './dist/'
        },
        notify: false,
        reloadOnRestart: false
    },

    pug: {
        src: 'source/**/*.pug',
        pretty: '\t'
    },

    styl: {
        src: 'source/static/styles/**/*.styl'
    },

    include: {
        hardFail: true,
        includePaths: [
            __dirname + '/',
            __dirname + '/node_modules',
            __dirname + '/source/static/scripts/plugins'
        ]
    },

    imagemin: {
        images: [
            $.imagemin.gifsicle({
                interlaced: true,
                optimizationLevel: 3
            }),
            $.imagemin.jpegtran({
                progressive: true
            }),
            imageminPngquant(),
            $.imagemin.svgo({
                plugins: [
                    { cleanupIDs: false },
                    { removeViewBox: false },
                    { convertPathData: false },
                    { mergePaths: false }
                ]
            })
        ],

        icons: [
            $.imagemin.svgo({
                plugins: [
                    { removeTitle: true },
                    { removeStyleElement: true },
                    { removeAttrs: { attrs: [ 'id', 'class', 'data-name', 'fill', 'fill-rule' ] } },
                    { removeEmptyContainers: true },
                    { sortAttrs: true },
                    { removeUselessDefs: true },
                    { removeEmptyText: true },
                    { removeEditorsNSData: true },
                    { removeEmptyAttrs: true },
                    { removeHiddenElems: true },
                    { transformsWithOnePath: true }
                ]
            })
        ]
    },

    spritesmith: {
        imgPath: '../images/sprite.png',
        retinaImgPath: '../images/sprite@2x.png',
        retinaSrcFilter: '**/*@2x.png',
        imgName: 'sprite.png',
        retinaImgName: 'sprite@2x.png',
        cssName: 'sprite.styl',
        algorithm: 'binary-tree',
        padding: 8,
        cssTemplate: './source/static/styles/templates/sprite-template.mustache'
    }
};


// Build sprite
gulp.task('build-sprite', () => {
    var spriteData = gulp.src([ '**/*.png', '!**/_*.png' ], { cwd: 'assets/images/sprite' })
        .pipe(spritesmith(options.spritesmith));

    spriteData.img.pipe(buffer())
        .pipe($.imagemin(options.imagemin.images))
        .pipe(gulp.dest('dist/assets/images'));

    spriteData.css.pipe(buffer())
        .pipe(gulp.dest('tmp'));

    return spriteData.img.pipe(buffer());
});


// Browser sync 
gulp.task('browser-sync', () =>  {
    browserSync.init(options.browserSync);
});


// Minify images
gulp.task('build-img', () => {
    return gulp.src('**/*.{jpg,gif,svg,png}', {cwd: 'assets/images/img/'})
        .pipe($.plumber(options.plumber))
        .pipe($.changed('dist/images'))
        .pipe($.imagemin(options.imagemin.images))
        .pipe(gulp.dest('dist/assets/images'));
});


// Build data json
gulp.task('data', () => {
    return gulp.src([ '**/*.yml', '!**/_*.yml' ], { cwd: 'source/modules/*/data' })
        .pipe($.plumber(options.plumber))
        .pipe($.yaml({ space: '\t' }))
        .pipe($.mergeJson('data.json'))
        .pipe(gulp.dest('tmp'));
});


// Compile html
gulp.task('pug', function (cb){

    var jsonData = getJsonData('./tmp/data.json');
    options.pug.locals = jsonData;

    new Promise((resolve, reject) => {
        emitty.scan(global.changedStyleFile).then(() => {
            return gulp.src(['**/*.pug', '!**/_*.pug'],{cwd: 'source/pages'})
                .pipe($.plumber(options.plumber))
                .pipe(gulpif(global.watch, emitty.filter(global.emittyChangedFile)))
                .pipe($.pug(options.pug))
                .pipe(htmlPrettify(options.htmlPrettify))
                .pipe(gulp.dest('./dist/'))
                .on('end', resolve)
                .on('error', reject)
                .pipe(browserSync.stream());
        });
    })
    cb();
});


// Compile css
gulp.task('stylus', () => {
    return gulp.src(['*.styl', '!_*.styl'], {cwd: 'source/static/styles'})
        .pipe($.plumber(options.plumber))
        .pipe(stylus({
            use: nib()
        }))
        .pipe(gcmq({beautify: true}))
        .pipe(csscomb())
        .pipe(gulp.dest('dist/assets/css'))
        .pipe(csso())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('dist/assets/css'))
        .pipe(browserSync.reload({
            stream: true,
            match: '**/*.css'
        }));
});


gulp.task('build-assets', function() {
    var scriptsFilter = $.filter([ '**/*.js', '!**/*.min.js' ], { restore: true });

    return gulp.src([ '**/*.*', '!**/_*.*' ], { cwd: 'source/static/assets' })
        .pipe($.plumber(options.plumber))
        .pipe($.changed('dist/assets'))

        // Minify JavaScript files
        .pipe(scriptsFilter)
        .pipe(gulp.dest('dist/assets'))
        .pipe($.uglify())
        .pipe($.rename({ suffix: '.min' }))
        .pipe(scriptsFilter.restore)

        // Copy other files
        .pipe(gulp.dest('dist/assets'));
});


// // Js combine
// gulp.task('combine-modules-scripts', () => {
//     return gulp.src(['plugins.js'], {cwd: 'source/static/scripts'})
//         .pipe($.plumber(options.plumber))
//         .pipe($.concat('plugins.js', { newLine: '\n\n' }))
//         .pipe(gulp.dest('dist/assets/js/plugins/'));
// });


gulp.task('combine-scripts', function() {
    return gulp.src([ '*.js', '!_*.js' ], { cwd: 'source/static/scripts' })
        .pipe($.plumber(options.plumber))
        .pipe($.sourcemaps.init())
        .pipe($.include(options.include))
        .pipe(gulp.dest('dist/assets/js'))
        .pipe($.uglify())
        .pipe($.rename({ suffix: '.min' }))
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest('dist/assets/js'));
});


// Build zip
gulp.task('build-zip', () => {

    //var datetime = '-' + new Date();
    var datetime = ' - ' + getDateTime();
    var zipName = sourceName + datetime + '.zip';


    return gulp.src('dist/**/*')
        .pipe(gulpZip(zipName))
        .pipe(gulp.dest('zip'));
});



// Build html with data
gulp.task(
    'build-html',
    gulp.series(
        'data',
        'pug'
        )
    )


// Build css
// gulp.task(
//     'build-css',
//     gulp.parallel(
//         'dev:combine-stiles',
//         'stylus'
//         )
//     )


// Build js
gulp.task(
    'build-js',
    gulp.parallel(

        'combine-scripts'
        )
    )


// Build task
gulp.task(
    'build',
    gulp.series(
        gulp.parallel(
            'build-html',
            'build-js',
            'build-img',
            'build-assets',
            'build-sprite'
            ),
        'stylus'
        )
    )


// Zip task
gulp.task('zip',
    gulp.parallel (
        'build',
        'build-img',
        'build-zip'
        )
    )


// Watcch task
gulp.task('watch', () => {
    // Shows that run "watch" mode
    global.watch = true;


    // Modules pug
    $.watch('source/**/*.pug', gulp.series('pug'))
        .on('all', (event, filepath) => {
            global.emittyChangedFile = filepath;
        });


    // Modules data
    $.watch('source/modules/*/data/*.yml', gulp.series('build-html'));


    // Modules styles
    $.watch(options.styl.src, gulp.series('stylus'));


    // Modules combine-styles
    $.watch('source/modules/**/*.styl', gulp.series('stylus'));
    

    // Modules images
    $.watch('assets/**/*.{jpg,gif,svg,png}', gulp.series('build-img', browserSync.reload));


    // Modules scripts
    $.watch('source/modules/*/*.js', gulp.series('build-js' , browserSync.reload));


    // Static scripts
    $.watch('source/static/scripts/**/*.js', gulp.series('build-js', browserSync.reload));


    // Modules sprites
    $.watch('assets/images/sprite/**/*.png', gulp.series('build-sprite', browserSync.reload));


    // Static files
    $.watch('source/static/assets/**/*', gulp.series('build-assets', browserSync.reload));
});


// Gulp dev task
gulp.task(
    'dev',
    gulp.series(
        'build',
        gulp.parallel(
            'browser-sync',
            'watch'
            )
        )
    )
