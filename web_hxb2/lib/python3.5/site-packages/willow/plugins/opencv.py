from __future__ import absolute_import

import io
import os

from willow.image import Image, RGBImageBuffer


def _cv():
    import cv
    return cv


class BaseOpenCVImage(Image):
    def __init__(self, image, size):
        self.image = image
        self.size = size

    @classmethod
    def check(cls):
        _cv()

    @Image.operation
    def get_size(self):
        return self.size

    @Image.operation
    def has_alpha(self):
        # Alpha is not supported by OpenCV
        return False

    @Image.operation
    def has_animation(self):
        # Animation is not supported by OpenCV
        return False


class OpenCVColorImage(BaseOpenCVImage):
    @classmethod
    @Image.converter_from(RGBImageBuffer)
    def from_buffer_rgb(cls, image_buffer):
        cv = _cv()

        image = cv.CreateImageHeader(image_buffer.size, cv.IPL_DEPTH_8U, 3)
        cv.SetData(image, image_buffer.data)
        return cls(image, image_buffer.size)

    # TODO: Converter back to RGBImageBuffer


class OpenCVGrayscaleImage(BaseOpenCVImage):
    @Image.operation
    def detect_features(self):
        cv = _cv()
        rows, cols = self.size

        eig_image = cv.CreateMat(rows, cols, cv.CV_32FC1)
        temp_image = cv.CreateMat(rows, cols, cv.CV_32FC1)
        points = cv.GoodFeaturesToTrack(self.image, eig_image, temp_image, 20, 0.04, 1.0, useHarris=False)

        return points

    @Image.operation
    def detect_faces(self, cascade_filename='haarcascade_frontalface_alt2.xml'):
        cv = _cv()

        # If a relative path was provided, check local cascades directory
        if not os.path.isabs(cascade_filename):
            cascade_filename = os.path.join(
                os.path.dirname(os.path.dirname(__file__)),
                'data/cascades',
                cascade_filename,
            )

        # Load cascade file
        cascade = cv.Load(cascade_filename)

        # Equalise the images histogram
        equalised_image = cv.CloneImage(self.image)
        cv.EqualizeHist(self.image, equalised_image)

        # Detect faces
        min_size = (40, 40)
        haar_scale = 1.1
        min_neighbors = 3
        haar_flags = 0

        faces = cv.HaarDetectObjects(
            equalised_image, cascade, cv.CreateMemStorage(0),
            haar_scale, min_neighbors, haar_flags, min_size
        )

        return [
            (
                face[0][0],
                face[0][1],
                face[0][0] + face[0][2],
                face[0][1] + face[0][3],
            ) for face in faces
        ]

    @classmethod
    @Image.converter_from(OpenCVColorImage)
    def from_color(cls, colour_image):
        cv = _cv()

        image = cv.CreateImage(colour_image.size, 8, 1)
        cv.CvtColor(colour_image.image, image, cv.CV_RGB2GRAY)
        return cls(image, colour_image.size)


willow_image_classes = [OpenCVColorImage, OpenCVGrayscaleImage]
