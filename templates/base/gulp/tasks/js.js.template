import webpack from 'webpack-stream';
import TerserPlugin from 'terser-webpack-plugin';
import ESLintPlugin from 'eslint-webpack-plugin';
import { WebpackManifestPlugin } from 'webpack-manifest-plugin';

export const js = () => {
	return app.gulp
		.src(app.path.src.js, { sourcemaps: app.isDev })
		.pipe(
			app.plugins.plumber(
				app.plugins.notify.onError({
					title: 'JS',
					message: 'Error: <%= error.message %>',
				}),
			),
		)
		.pipe(
			webpack({
				mode: app.isBuild ? 'production' : 'development',
				entry: {
					app: `${app.path.src.js}/app.js`,
				},
				output: {
					filename: '[name].min.js',
					chunkFilename: '[name].chunk.js',
				},
				cache: {
					type: 'filesystem',
				},
				optimization: {
					splitChunks: {
						chunks: 'all',
						cacheGroups: {
							vendors: {
								test: /[\\/]node_modules[\\/]/,
								name: 'vendors',
								chunks: 'all',
								priority: -10,
							},
							default: {
								minChunks: 2,
								priority: -20,
								reuseExistingChunk: true,
							},
						},
					},
					minimize: app.isBuild,
					minimizer: app.isBuild ? [new TerserPlugin()] : [],
				},
				module: {
					rules: [
						{
							test: /\.js$/,
							exclude: /node_modules/,
							loader: 'babel-loader',
							options: {
								presets: ['@babel/preset-env'],
							},
						},
						{
							test: /\.(sass|scss|css)$/,
							use: ['style-loader', 'css-loader', 'sass-loader'],
						},
					],
				},
				plugins: [
					new ESLintPlugin({
						context: './node_modules/@wordpress/eslint-plugin',
					}),
					new WebpackManifestPlugin({
						fileName: 'manifest.json',
						publicPath: '/dist/js/',
					}),
				],
			}),
		)
		.pipe(app.gulp.dest(app.path.build.js));
};
