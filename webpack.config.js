const path = require('path');
const webpack = require('webpack');
var StyleLintPlugin = require('stylelint-webpack-plugin');

module.exports = {
  entry: {
    material: './app/Resources/static/themes/material/index.js',
    baggy: './app/Resources/static/themes/baggy/index.js'
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'web/bundles/wallabagcore')
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.$': 'jquery',
      'window.jQuery': 'jquery'
    }),
    new StyleLintPlugin({
      configFile: '.stylelintrc',
      failOnError: false,
      quiet: false,
      context: 'app/Resources/static/themes',
      files: '**/*.css',
    }),
  ],
  module: {
    rules: [{
      test: /\.css$/,
      use: [
        'style-loader',
        {
          loader: 'css-loader',
          options: {
            importLoaders: 1
          }
        },
        {
          loader: 'postcss-loader',
          options: {
            plugins: function () {
              return [
                require('autoprefixer'),
              ];
            }
          }
        }
      ]
    },
    {
      test: /\.(png|eot|svg|ttf|woff|woff2)$/,
      use: 'url-loader'
    }
    ]
  },
  resolve: {
    alias: {
      'jquery': path.resolve(__dirname, 'node_modules/jquery/dist/jquery.js')
    }
  },
};


