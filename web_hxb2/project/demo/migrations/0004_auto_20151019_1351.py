# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations
import wagtail.wagtailimages.blocks
import wagtail.wagtailcore.blocks
import wagtail.wagtailcore.fields
import wagtail.wagtaildocs.blocks
import demo.models


class Migration(migrations.Migration):

    dependencies = [
        ('demo', '0003_auto_20150917_1200'),
    ]

    operations = [
        migrations.AlterField(
            model_name='blogindexpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='blogindexpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='blogpage',
            name='body',
            field=wagtail.wagtailcore.fields.StreamField((('h2', wagtail.wagtailcore.blocks.CharBlock(icon='title', classname='title')), ('h3', wagtail.wagtailcore.blocks.CharBlock(icon='title', classname='title')), ('h4', wagtail.wagtailcore.blocks.CharBlock(icon='title', classname='title')), ('intro', wagtail.wagtailcore.blocks.RichTextBlock(icon='pilcrow')), ('paragraph', wagtail.wagtailcore.blocks.RichTextBlock(icon='pilcrow')), ('aligned_image', wagtail.wagtailcore.blocks.StructBlock((('image', wagtail.wagtailimages.blocks.ImageChooserBlock()), ('caption', wagtail.wagtailcore.blocks.RichTextBlock()), ('alignment', demo.models.ImageFormatChoiceBlock())), label='Aligned image', icon='image')), ('pullquote', wagtail.wagtailcore.blocks.StructBlock((('quote', wagtail.wagtailcore.blocks.TextBlock('quote title')), ('attribution', wagtail.wagtailcore.blocks.CharBlock())))), ('aligned_html', wagtail.wagtailcore.blocks.StructBlock((('html', wagtail.wagtailcore.blocks.RawHTMLBlock()), ('alignment', demo.models.HTMLAlignmentChoiceBlock())), label='Raw HTML', icon='code')), ('document', wagtail.wagtaildocs.blocks.DocumentChooserBlock(icon='doc-full-inverse')))),
        ),
        migrations.AlterField(
            model_name='blogpage',
            name='date',
            field=models.DateField(verbose_name='Post date'),
        ),
        migrations.AlterField(
            model_name='blogpagecarouselitem',
            name='embed_url',
            field=models.URLField(verbose_name='Embed URL', blank=True),
        ),
        migrations.AlterField(
            model_name='blogpagecarouselitem',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='blogpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='blogpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='contactpage',
            name='email',
            field=models.EmailField(max_length=254, blank=True),
        ),
        migrations.AlterField(
            model_name='eventindexpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='eventindexpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='eventpage',
            name='audience',
            field=models.CharField(max_length=255, choices=[('public', 'Public'), ('private', 'Private')]),
        ),
        migrations.AlterField(
            model_name='eventpage',
            name='date_from',
            field=models.DateField(verbose_name='Start date'),
        ),
        migrations.AlterField(
            model_name='eventpage',
            name='date_to',
            field=models.DateField(help_text='Not required if event is on a single day', verbose_name='End date', null=True, blank=True),
        ),
        migrations.AlterField(
            model_name='eventpage',
            name='time_from',
            field=models.TimeField(verbose_name='Start time', null=True, blank=True),
        ),
        migrations.AlterField(
            model_name='eventpage',
            name='time_to',
            field=models.TimeField(verbose_name='End time', null=True, blank=True),
        ),
        migrations.AlterField(
            model_name='eventpagecarouselitem',
            name='embed_url',
            field=models.URLField(verbose_name='Embed URL', blank=True),
        ),
        migrations.AlterField(
            model_name='eventpagecarouselitem',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='eventpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='eventpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='eventpagespeaker',
            name='first_name',
            field=models.CharField(max_length=255, verbose_name='Name', blank=True),
        ),
        migrations.AlterField(
            model_name='eventpagespeaker',
            name='last_name',
            field=models.CharField(max_length=255, verbose_name='Surname', blank=True),
        ),
        migrations.AlterField(
            model_name='eventpagespeaker',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='choices',
            field=models.CharField(max_length=512, help_text='Comma separated list of choices. Only applicable in checkboxes, radio and dropdown.', verbose_name='Choices', blank=True),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='default_value',
            field=models.CharField(max_length=255, help_text='Default value. Comma separated values supported for checkboxes.', verbose_name='Default value', blank=True),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='field_type',
            field=models.CharField(max_length=16, choices=[('singleline', 'Single line text'), ('multiline', 'Multi-line text'), ('email', 'Email'), ('number', 'Number'), ('url', 'URL'), ('checkbox', 'Checkbox'), ('checkboxes', 'Checkboxes'), ('dropdown', 'Drop down'), ('radio', 'Radio buttons'), ('date', 'Date'), ('datetime', 'Date/time')], verbose_name='Field type'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='help_text',
            field=models.CharField(max_length=255, verbose_name='Help text', blank=True),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='label',
            field=models.CharField(max_length=255, help_text='The label of the form field', verbose_name='Label'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='required',
            field=models.BooleanField(verbose_name='Required', default=True),
        ),
        migrations.AlterField(
            model_name='formpage',
            name='from_address',
            field=models.CharField(max_length=255, verbose_name='From address', blank=True),
        ),
        migrations.AlterField(
            model_name='formpage',
            name='subject',
            field=models.CharField(max_length=255, verbose_name='Subject', blank=True),
        ),
        migrations.AlterField(
            model_name='formpage',
            name='to_address',
            field=models.CharField(max_length=255, help_text='Optional - form submissions will be emailed to this address', verbose_name='To address', blank=True),
        ),
        migrations.AlterField(
            model_name='homepage',
            name='body',
            field=wagtail.wagtailcore.fields.StreamField((('h2', wagtail.wagtailcore.blocks.CharBlock(icon='title', classname='title')), ('h3', wagtail.wagtailcore.blocks.CharBlock(icon='title', classname='title')), ('h4', wagtail.wagtailcore.blocks.CharBlock(icon='title', classname='title')), ('intro', wagtail.wagtailcore.blocks.RichTextBlock(icon='pilcrow')), ('paragraph', wagtail.wagtailcore.blocks.RichTextBlock(icon='pilcrow')), ('aligned_image', wagtail.wagtailcore.blocks.StructBlock((('image', wagtail.wagtailimages.blocks.ImageChooserBlock()), ('caption', wagtail.wagtailcore.blocks.RichTextBlock()), ('alignment', demo.models.ImageFormatChoiceBlock())), label='Aligned image', icon='image')), ('pullquote', wagtail.wagtailcore.blocks.StructBlock((('quote', wagtail.wagtailcore.blocks.TextBlock('quote title')), ('attribution', wagtail.wagtailcore.blocks.CharBlock())))), ('aligned_html', wagtail.wagtailcore.blocks.StructBlock((('html', wagtail.wagtailcore.blocks.RawHTMLBlock()), ('alignment', demo.models.HTMLAlignmentChoiceBlock())), label='Raw HTML', icon='code')), ('document', wagtail.wagtaildocs.blocks.DocumentChooserBlock(icon='doc-full-inverse')))),
        ),
        migrations.AlterField(
            model_name='homepagecarouselitem',
            name='embed_url',
            field=models.URLField(verbose_name='Embed URL', blank=True),
        ),
        migrations.AlterField(
            model_name='homepagecarouselitem',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='homepagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='homepagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='personpage',
            name='email',
            field=models.EmailField(max_length=254, blank=True),
        ),
        migrations.AlterField(
            model_name='personpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='personpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='standardindexpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='standardindexpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
        migrations.AlterField(
            model_name='standardpagecarouselitem',
            name='embed_url',
            field=models.URLField(verbose_name='Embed URL', blank=True),
        ),
        migrations.AlterField(
            model_name='standardpagecarouselitem',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='standardpagerelatedlink',
            name='link_external',
            field=models.URLField(verbose_name='External link', blank=True),
        ),
        migrations.AlterField(
            model_name='standardpagerelatedlink',
            name='title',
            field=models.CharField(max_length=255, help_text='Link title'),
        ),
    ]
