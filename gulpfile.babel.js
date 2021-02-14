import { src, dest, watch, series, parallel } from 'gulp';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import webpack from 'webpack-stream';
import del from 'del';

export const styles = () => {
    return src('src/scss/bundle.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([ autoprefixer ]))
        .pipe(cleanCss({compatability:'ie8'}))
        .pipe(sourcemaps.write())
        .pipe(dest('public/css'));
}

export const images = () => {
    return src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
        .pipe(imagemin())
        .pipe(dest('dist/images'));
}

export const scripts = () => {
    return src('src/scripts/bundle.js')
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
            mode: 'production',
            devtool: 'inline-source-map',
            output: {
                filename: 'bundle.js'
            }
        }))
        .pipe(dest('public/js'));
}

export const copy = () => {
    return src(['src/**/*', '!src/{images,scripts,scss}','!src/{images,scripts,scss}/**/*'] )
        .pipe(dest('dist'));
}

export const watchForChanges = () => {
    return [
        watch('src/scss/**/*.scss', styles ),
        watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', images ),
        watch('src/scripts/**/*.js', scripts),
        watch(['src/**/*', '!src/{images,scripts,scss}','!src/{images,scripts,scss}/**/*'], copy )
    ];
}

export const clean = () => {
    return del(['dist']);
}

const coreTasks = parallel( styles, images, scripts, copy );

export const dev = series(clean, coreTasks, watchForChanges);
export const build = series(clean, coreTasks );
export default dev;
