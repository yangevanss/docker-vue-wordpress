const fs = require('fs')
const path = require('path')
fs.readFile(path.resolve(__dirname, '../wordpress/wp-config.php'), 'utf8', function (err, data) {
    if (err) {
        return console.log(err)
    }

    const result = data.replace(
        /define\( 'WP_DEBUG', !!getenv_docker\('WORDPRESS_DEBUG', ''\) \);|define\( 'WP_DEBUG', false \);/gm,
        `define( 'WP_DEBUG', ${process.env.NODE_ENV === 'development' ? "!!getenv_docker('WORDPRESS_DEBUG', '')" : 'false'} );`
    )

    fs.writeFile(path.resolve(__dirname, '../wordpress/wp-config.php'), result, 'utf8', function (err) {
        if (err) return console.log(err)
    })
})
