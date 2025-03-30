import * as nodePath from 'path';

const rootFolder = nodePath.basename(nodePath.resolve());

const buildFolder = `./dist`;
const srcFolder = `./assets`;

export const path = {
    build: {
        js: `${buildFolder}/js/`,
        css: `${buildFolder}/css/`,
        images: `${buildFolder}/img/`,
        // fonts: `${buildFolder}/fonts/`,
    },
    src: {
        js: `${srcFolder}/js`,
        scss: `${srcFolder}/scss/*.scss`,
        php: ['**/*.php', '!vendor/**/*.php'],
        images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp}`,
        svg: `${srcFolder}/img/**/*.svg`,
        // fonts: `${srcFolder}/fonts/*.*`,
    },
    watch: {
        js: `${srcFolder}/js/**/*.js`,
        scss: `${srcFolder}/scss/**/*.scss`,
        php: ['**/*.php', '!vendor/**/*.php'],
        images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp,svg,ico}`,
    },
    clean: buildFolder,
    buildFolder: buildFolder,
    srcFolder: srcFolder,
    rootFolder: rootFolder,
};
