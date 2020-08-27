import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCSS from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import minify from 'gulp-minify';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from "browser-sync";
import zip from "gulp-zip";
import info from "./package.json";
import replace from "gulp-replace";
import wpPot from "gulp-wp-pot";
import filter from "gulp-filter";
import clean from "gulp-clean";

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();
export const serve = done => {
    server.init({
        proxy: "http://localhost/champagne-spas-landing/"
    });
    done();
};
export const reload = done => {
    server.reload();
    done();
};
export const cleaner = () => del(['dist']);

export const styles = () => {
    return src(['src/scss/**/*.scss'])
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(!PRODUCTION,replace(/http:\/\/localhost:3000\/champagne-spas-landing\//g, 'http://localhost/champagne-spas-landing/')))
        .pipe(gulpif(PRODUCTION, replace(/http:\/\/localhost:3000\/champagne-spas-landing\//g, '/')))
        .pipe(gulpif(PRODUCTION, replace(/http:\/\/localhost\/champagne-spas-landing\//g, '/')))
        .pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
        .pipe(gulpif(PRODUCTION, cleanCSS({compatibility:'ie8'})))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(dest('dist/css'))
        .pipe(server.stream());
}
export const images = () => {
    return src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(dest('dist/images'));
}
export const copy = () => {
    return src(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'])
        .pipe(dest('dist'));
}
export const fontawesome = () => {
    return src('node_modules/@fortawesome/fontawesome-free/webfonts/*')
        .pipe(dest('dist/webfonts'))
}
export const scripts = () => {
    return src(['src/js/**/*.js'])
        .pipe(named())
        .pipe(webpack({
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: []
                            }
                        }
                    }
                ]
            },
            mode: PRODUCTION ? 'production' : 'development',
            devtool: !PRODUCTION ? 'inline-source-map' : false,
            output: {
                filename: '[name].js'
            },
            externals: {
                jquery: 'jQuery'
            },
        }))
        .pipe(dest('dist/js'));
}
// export minified js to bundled theme
export const minjs = () => {
    return src(['src/js/**/*.js'])
        .pipe(minify())
        .pipe(dest('bundled/dist/js'))
}
// export minified css to bundled theme
export const mincss = () => {
    return src('dist/*.css', 'dist/**/*.css')
        .pipe(cleanCSS({minify: true}))
        .pipe(dest('bundled/dist/css'));
}
export const themeCopy = () => {
    return src([
        "**/*",
        "!node_modules{,/**}",
        "!bundled{,/**}",
        "!src{,/**}",
        "!.babelrc",
        "!.gitignore",
        "!gulpfile.babel.js",
        "!package.json",
        "!package-lock.json",
    ]).pipe(dest('bundled'));
}
export const compress = () => {
    return src([
        "bundled/*",
        "bundled/*/**"
    ])
        .pipe(
            gulpif(
                file => file.relative.split(".").pop() !== "zip",
                replace("_themename", info.name)
            )
        )
        .pipe(zip(`${info.name}.zip`))
        .pipe(dest('bundled'));
};
// empty bundled folder before sending new files there
export const clear = () => {
    return src('bundled/*')
        .pipe(clean())
}
// delete all files except for theme zip
export const destroy = () => {
    return src('bundled/*', {read: false})
        .pipe(filter(['**/*', '!**/*.zip', '!**/*.zip/**/*'], {restore: true}))
        .pipe(clean());
}
// functions file enqueues minified css and js --search and replace strings
export const prodLinks = () => {
    return src('bundled/functions.php')
        .pipe(replace('.css', '.min.css'))
        .pipe(dest('bundled/', { overwrite: true }))
}
export const pot = () => {
    return src("**/*.php")
        .pipe(
            wpPot({
                domain: "_themename",
                package: info.name
            })
        )
        .pipe(dest(`languages/${info.name}.pot`));
};
export const watchForChanges = () => {
    watch('src/scss/**/*.scss', styles);
    watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
    watch(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'], series(copy, reload));
    watch('src/js/**/*.js', series(scripts, reload));
    watch("**/*.php", reload);
}
export const dev = series(cleaner, parallel(styles, fontawesome, images, copy, scripts), serve, watchForChanges);
export const build = series(cleaner, parallel(styles, fontawesome, images, copy, scripts), clear, themeCopy, minjs, mincss, prodLinks, pot, compress, destroy);
export default dev;