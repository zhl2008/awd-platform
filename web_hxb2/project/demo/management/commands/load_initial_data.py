import os, shutil

from django.conf import settings
from django.core.management.base import BaseCommand
from django.core.management import call_command


class Command(BaseCommand):
    def handle(self, **options):
        fixtures_dir = os.path.join(settings.PROJECT_ROOT, 'demo', 'fixtures')
        fixture_file = os.path.join(fixtures_dir, 'demo.json')
        image_src_dir = os.path.join(fixtures_dir, 'images')
        image_dest_dir = os.path.join(settings.MEDIA_ROOT, 'original_images')

        call_command('loaddata', fixture_file, verbosity=0)

        if not os.path.isdir(image_dest_dir):
            os.makedirs(image_dest_dir)

        for filename in os.listdir(image_src_dir):
            shutil.copy(os.path.join(image_src_dir, filename), image_dest_dir)
