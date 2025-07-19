const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

/**@type {import('webpack').Configuration} */

const cssLoaders = {
  test: /\.css$/,
  use: [MiniCssExtractPlugin.loader, 'css-loader'],
}
const babelloader =  {
  test: /\.js$/,
  exclude: /node_modules/,
  use: {
    loader: 'babel-loader',
    options: {
          presets: ['@babel/preset-env']
        }
  }
}

const entry_props = {};

entry_props.app_cat = './public/js/src/app_cat.js';
entry_props.ajaxforms = './public/js/src/ajaxforms.js';


module.exports ={
    entry: entry_props, // Archivo principal de entrada
    mode: 'production', // Modo de producción
    devtool: 'source-map',
    output: {
        filename: '[name].bundle.js', // Nombre del archivo de salida
        path: path.resolve(__dirname, '../public/js/dist'), // Carpeta de salida
    },
    optimization: {
           splitChunks:{
            chunks: "all",
           },
           minimize : true,
           minimizer : [new TerserPlugin({
            test: /.(js|jsx)$/,
            exclude: /node_modules/,
              extractComments: true, // Esto evita que los comentarios se extraigan a archivos separados
           })]
        },
      plugins: [
        new MiniCssExtractPlugin(),
    new CleanWebpackPlugin()],
      module: {
        rules: [babelloader, cssLoaders,   
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: ['file-loader']
            }],
        
      },
}