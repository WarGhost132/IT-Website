const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

module.exports = {
	mode: 'development',
	entry: {
		main: path.resolve(__dirname, '../../assembly/index.js'),
	},
	output: {
		filename: 'bundle.js',
		path: path.resolve(__dirname, '../../assets'),
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						configFile: path.resolve(__dirname, '.babelrc'),
					},
				},
			},
			{
				test: /\.css$/i,
				use: [MiniCssExtractPlugin.loader, 'css-loader'],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'bundle.css',
		}),
	],
}
