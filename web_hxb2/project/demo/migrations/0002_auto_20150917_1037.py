# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations
import demo.models
import wagtail.wagtaildocs.blocks
import wagtail.wagtailimages.blocks
import wagtail.wagtailcore.fields
import wagtail.wagtailcore.blocks


class Migration(migrations.Migration):

    dependencies = [
        ('demo', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='homepage',
            name='body',
            field=wagtail.wagtailcore.fields.StreamField([(b'h2', wagtail.wagtailcore.blocks.CharBlock(classname=b'title', icon=b'title')), (b'h3', wagtail.wagtailcore.blocks.CharBlock(classname=b'title', icon=b'title')), (b'h4', wagtail.wagtailcore.blocks.CharBlock(classname=b'title', icon=b'title')), (b'intro', wagtail.wagtailcore.blocks.RichTextBlock(icon=b'pilcrow')), (b'paragraph', wagtail.wagtailcore.blocks.RichTextBlock(icon=b'pilcrow')), (b'aligned_image', wagtail.wagtailcore.blocks.StructBlock([(b'image', wagtail.wagtailimages.blocks.ImageChooserBlock()), (b'caption', wagtail.wagtailcore.blocks.RichTextBlock()), (b'alignment', demo.models.ImageFormatChoiceBlock())], icon=b'image', label=b'Aligned image')), (b'pullquote', wagtail.wagtailcore.blocks.StructBlock([(b'quote', wagtail.wagtailcore.blocks.TextBlock(b'quote title')), (b'attribution', wagtail.wagtailcore.blocks.CharBlock())])), (b'aligned_html', wagtail.wagtailcore.blocks.StructBlock([(b'html', wagtail.wagtailcore.blocks.RawHTMLBlock()), (b'alignment', demo.models.HTMLAlignmentChoiceBlock())], label=b'Raw HTML', icon=b'code')), (b'document', wagtail.wagtaildocs.blocks.DocumentChooserBlock(icon=b'doc-full-inverse'))]),
        )
    ]
