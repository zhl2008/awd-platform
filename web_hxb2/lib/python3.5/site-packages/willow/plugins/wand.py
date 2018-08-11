from __future__ import absolute_import

import functools

from willow.image import (
    Image,
    JPEGImageFile,
    PNGImageFile,
    GIFImageFile,
    BMPImageFile,
    RGBImageBuffer,
    RGBAImageBuffer,
)


def _wand_image():
    import wand.image
    return wand.image


def _wand_api():
    import wand.api
    return wand.api


class WandImage(Image):
    def __init__(self, image):
        self.image = image

    @classmethod
    def check(cls):
        _wand_image()
        _wand_api()

    def _clone(self):
        return WandImage(self.image.clone())

    @Image.operation
    def get_size(self):
        return self.image.size

    @Image.operation
    def has_alpha(self):
        return self.image.alpha_channel

    @Image.operation
    def has_animation(self):
        return self.image.animation

    @Image.operation
    def resize(self, size):
        clone = self._clone()
        clone.image.resize(size[0], size[1])
        return clone

    @Image.operation
    def crop(self, rect):
        clone = self._clone()
        clone.image.crop(left=rect[0], top=rect[1], right=rect[2], bottom=rect[3])
        return clone

    @Image.operation
    def save_as_jpeg(self, f, quality=85, optimize=False, progressive=False):
        with self.image.convert('pjpeg' if progressive else 'jpeg') as converted:
            converted.compression_quality = quality
            converted.save(file=f)

        return JPEGImageFile(f)

    @Image.operation
    def save_as_png(self, f, optimize=False):
        with self.image.convert('png') as converted:
            converted.save(file=f)

        return PNGImageFile(f)

    @Image.operation
    def save_as_gif(self, f):
        with self.image.convert('gif') as converted:
            converted.save(file=f)

        return GIFImageFile(f)

    @Image.operation
    def auto_orient(self):
        image = self.image

        if image.orientation not in ['top_left', 'undefined']:
            image = image.clone()
            if hasattr(image, 'auto_orient'):
                # Wand 0.4.1 +
                image.auto_orient()
            else:
                orientation_ops = {
                    'top_right': [image.flop],
                    'bottom_right': [functools.partial(image.rotate, degree=180.0)],
                    'bottom_left': [image.flip],
                    'left_top': [image.flip, functools.partial(image.rotate, degree=90.0)],
                    'right_top': [functools.partial(image.rotate, degree=90.0)],
                    'right_bottom': [image.flop, functools.partial(image.rotate, degree=90.0)],
                    'left_bottom': [functools.partial(image.rotate, degree=270.0)]
                }
                fns = orientation_ops.get(image.orientation)

                if fns:
                    for fn in fns:
                        fn()

                    image.orientation = 'top_left'

        return WandImage(image)

    @Image.operation
    def get_wand_image(self):
        return self.image

    @classmethod
    @Image.converter_from(JPEGImageFile, cost=150)
    @Image.converter_from(PNGImageFile, cost=150)
    @Image.converter_from(GIFImageFile, cost=150)
    @Image.converter_from(BMPImageFile, cost=150)
    def open(cls, image_file):
        image_file.f.seek(0)
        image = _wand_image().Image(file=image_file.f)
        image.wand = _wand_api().library.MagickCoalesceImages(image.wand)

        return cls(image)

    @Image.converter_to(RGBImageBuffer)
    def to_buffer_rgb(self):
        return RGBImageBuffer(self.image.size, self.image.make_blob('RGB'))

    @Image.converter_to(RGBAImageBuffer)
    def to_buffer_rgba(self):
        return RGBImageBuffer(self.image.size, self.image.make_blob('RGBA'))


willow_image_classes = [WandImage]
