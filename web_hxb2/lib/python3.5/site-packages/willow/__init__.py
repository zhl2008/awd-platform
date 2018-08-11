from willow.image import Image

def setup():
    from willow.registry import registry

    from willow.image import (
        JPEGImageFile,
        PNGImageFile,
        GIFImageFile,
        BMPImageFile,
        RGBImageBuffer,
        RGBAImageBuffer,
    )
    from willow.plugins import pillow, wand, opencv

    registry.register_image_class(JPEGImageFile)
    registry.register_image_class(PNGImageFile)
    registry.register_image_class(GIFImageFile)
    registry.register_image_class(BMPImageFile)
    registry.register_image_class(RGBImageBuffer)
    registry.register_image_class(RGBAImageBuffer)

    registry.register_plugin(pillow)
    registry.register_plugin(wand)
    registry.register_plugin(opencv)

setup()


__version__ = '0.4'
