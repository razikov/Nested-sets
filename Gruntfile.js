const babel = require("rollup-plugin-babel");
const resolve = require("rollup-plugin-node-resolve");
const tilde_importer = require("grunt-sass-tilde-importer");
const nodeGlobals = require("rollup-plugin-node-globals");
const vue = require("rollup-plugin-vue");
const babelrc = require("babelrc-rollup");
const commonjs = require("rollup-plugin-commonjs");
const replace = require("rollup-plugin-replace");
const alias = require('rollup-plugin-alias');

module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON("package.json"),
        rollup: {
            options: {
                format: "iife",
                interop: null,
                plugins: [
                    alias({
                        'vue': 'vue/dist/vue.runtime.esm.js'
                    }),
                    replace({"process.env.NODE_ENV": JSON.stringify("dev")}),
                    resolve({
                        jsnext: true,
                        main: true,
                        browser: true
                    }),
                    babel({
                        babelrc: false,
                        exclude: ['./node_modules/**/*'],
//                        presets: ["es2015"],
//                        plugins: ["external-helpers"],
                        plugins: ["@babel/plugin-proposal-class-properties"],
                    }),
                    nodeGlobals(),
                ]
            },
            default: {
                options: {
                    moduleName: "NS"
                },
                files: {
                    "runtime/script.js": "assets/js/entry.js"
                }
            }
        },
        concat: {
            options: {
                separator: ";",
            },
            dist: {
                src: [
                    "runtime/script.js"
                ],
                dest: "web/js/app.js",
            },
        }
    });

    grunt.loadNpmTasks("grunt-rollup");
    grunt.loadNpmTasks("grunt-contrib-concat");

    grunt.registerTask("default", ["rollup", "concat"]);
    grunt.registerTask("dev", ["default"]);
};
