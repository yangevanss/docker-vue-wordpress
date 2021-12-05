import WebFont from 'webfontloader'
import ImagesLoaded from 'imagesloaded'

export default () => {
    const loadFont = () => {
        return new Promise(resolve => {
            WebFont.load({
                google: {
                    families: ['Noto Sans TC:300,400,700&display=swap'],
                },
                active () {
                    resolve()
                },
            })
        })
    }
    const loadImage = () => {
        return new Promise(resolve => {
            new ImagesLoaded('#wrapper', { background: '[data-background]' }, (instance) => {
                resolve()
            })
        })
    }

    return {
        loadFont,
        loadImage,
    }
}
