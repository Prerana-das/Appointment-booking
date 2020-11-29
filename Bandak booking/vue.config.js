const webpack = require('webpack')
module.exports = {
  configureWebpack: {
    plugins: [
      new webpack.optimize.LimitChunkCountPlugin({
        maxChunks: 1
      })
    ]
  },
  // chainWebpack:
  //   config => {
  //     config.optimization.delete('splitChunks')
  //   },

    chainWebpack: config => {
      config.module.rules.delete('eslint');
  }
}
