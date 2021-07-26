const path = require('path');

module.exports = {
    watch: true,
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
