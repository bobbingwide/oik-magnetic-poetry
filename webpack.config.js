const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
module.exports = {
    ...defaultConfig,
    entry: {
        'magnetic-poetry': './src/oik-magnetic-poetry'
    },
};