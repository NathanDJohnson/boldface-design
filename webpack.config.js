const path = require('path');

module.exports = {
  mode: process.env.NODE_ENV || 'development',
  entry: './assets/js/main.js',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'assets/js'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
    ],
  },
};
