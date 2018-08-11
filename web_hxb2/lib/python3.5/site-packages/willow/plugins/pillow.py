from __future__ import absolute_import

from willow.image import (
    Image,
    JPEGImageFile,
    PNGImageFile,
    GIFImageFile,
    BMPImageFile,
    RGBImageBuffer,
    RGBAImageBuffer,
)


def _PIL_Image():
    import PIL.Image
    return PIL.Image


class PillowImage(Image):
    def __init__(self, image):
        self.image = image

    @classmethod
    def check(cls):
        _PIL_Image()

    @Image.operation
    def get_size(self):
        return self.image.size

    @Image.operation
    def has_alpha(self):
        img = self.image
        return img.mode in ('RGBA', 'LA') or (img.mode == 'P' and 'transparency' in img.info)

    @Image.operation
    def has_animation(self):
        # Animation is not supported by PIL
        return False

    @Image.operation
    def resize(self, size):
        # Convert 1 and P images to RGB to improve resize quality
        # (palleted images don't get antialiased or filtered when minified)
        if self.image.mode in ['1', 'P']:
            if self.has_alpha():
                image = self.image.convert('RGBA')
            else:
                image = self.image.convert('RGB')
        else:
            image = self.image

        return PillowImage(image.resize(size, _PIL_Image().ANTIALIAS))

    @Image.operation
    def crop(self, rect):
        return PillowImage(self.image.crop(rect))

    @Image.operation
    def save_as_jpeg(self, f, quality=85, optimize=False, progressive=False):
        if self.image.mode in ['1', 'P']:
            image = self.image.convert('RGB')
        else:
            image = self.image

        # Pillow only checks presence of optimize kwarg, not its value
        kwargs = {}
        if optimize:
            kwargs['optimize'] = True
        if progressive:
            kwargs['progressive'] = True

        image.save(f, 'JPEG', quality=quality, **kwargs)
        return JPEGImageFile(f)

    @Image.operation
    def save_as_png(self, f, optimize=False):
        # Pillow only checks presence of optimize kwarg, not its value
        kwargs = {}
        if optimize:
            kwargs['optimize'] = True

        self.image.save(f, 'PNG', **kwargs)
        return PNGImageFile(f)

    @Image.operation
    def save_as_gif(self, f):
        image = self.image

        # All gif files use either the L or P mode but we sometimes convert them
        # to RGB/RGBA to improve the quality of resizing. We must make sure that
        # they are converted back before saving.
        if image.mode not in ['L', 'P']:
            image = image.convert('P', palette=_PIL_Image().ADAPTIVE)

        if 'transparency' in image.info:
            image.save(f, 'GIF', transparency=image.info['transparency'])
        else:
            image.save(f, 'GIF')

        return GIFImageFile(f)

    @Image.operation
    def auto_orient(self):
        # JPEG files can be orientated using an EXIF tag.
        # Make sure this orientation is applied to the data
        image = self.image

        if hasattr(image, '_getexif'):
            try:
                exif = image._getexif()
            except Exception:
                # Blanket cover all the ways _getexif can fail in.
                exif = None
            if exif is not None:
                # 0x0112 = Orientation
                orientation = exif.get(0x0112, 1)

                if 1 <= orientation <= 8:
                    Image = _PIL_Image()
                    ORIENTATION_TO_TRANSPOSE = {
                        1: (),
                        2: (Image.FLIP_LEFT_RIGHT,),
                        3: (Image.ROTATE_180,),
                        4: (Image.ROTATE_180, Image.FLIP_LEFT_RIGHT),
                        5: (Image.ROTATE_270, Image.FLIP_LEFT_RIGHT),
                        6: (Image.ROTATE_270,),
                        7: (Image.ROTATE_90, Image.FLIP_LEFT_RIGHT),
                        8: (Image.ROTATE_90,),
                    }

                    for transpose in ORIENTATION_TO_TRANSPOSE[orientation]:
                        image = image.transpose(transpose)

        return PillowImage(image)

    @Image.operation
    def get_pillow_image(self):
        return self.image

    @classmethod
    @Image.converter_from(JPEGImageFile)
    @Image.converter_from(PNGImageFile)
    @Image.converter_from(GIFImageFile, cost=200)
    @Image.converter_from(BMPImageFile)
    def open(cls, image_file):
        image_file.f.seek(0)
        image = _PIL_Image().open(image_file.f)
        image.load()

        return cls(image)

    @Image.converter_to(RGBImageBuffer)
    def to_buffer_rgb(self):
        image = self.image

        if image.mode != 'RGB':
            image = image.convert('RGB')

        return RGBImageBuffer(image.size, image.tobytes())

    @Image.converter_to(RGBAImageBuffer)
    def to_buffer_rgba(self):
        image = self.image

        if image.mode != 'RGBA':
            image = image.convert('RGBA')

        return RGBAImageBuffer(image.size, image.tobytes())


willow_image_classes = [PillowImage]
