var webpack = require('webpack');

var config  = {
  module : {
    loaders : [{
      test    : /\.js$/,
      loader  : 'babel',
      exclude : /(node_modules|bower_components)/,
      include : __dirname
    }]
  },
  plugins : [
    /*new webpack.optimize.UglifyJsPlugin({
      comments : false
    })*/
  ]
};

// site public
var publicConfig = Object.assign({}, config, {
  context : __dirname,

  entry : {
    app : ["babel-polyfill", 'babel-regenerator-runtime', './_public/src/js/index.js']
  },

  output : {
    path     : './_public/build/js',
    filename : 'main.js'
  }
});

//site admin
var adminConfig = Object.assign({}, config, {
  context : __dirname,

  entry : {
    app : ["babel-polyfill", 'babel-regenerator-runtime', './_admin/src/js/index.js']
  },

  output : {
    path     : './_admin/build/js',
    filename : 'main.js'
  }
});



module.exports = [
  publicConfig, adminConfig
];
