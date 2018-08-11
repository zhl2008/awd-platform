# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('demo', '0004_auto_20151019_1351'),
    ]

    operations = [
        migrations.AlterField(
            model_name='formfield',
            name='choices',
            field=models.CharField(blank=True, max_length=512, verbose_name='choices', help_text='Comma separated list of choices. Only applicable in checkboxes, radio and dropdown.'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='default_value',
            field=models.CharField(blank=True, max_length=255, verbose_name='default value', help_text='Default value. Comma separated values supported for checkboxes.'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='field_type',
            field=models.CharField(choices=[('singleline', 'Single line text'), ('multiline', 'Multi-line text'), ('email', 'Email'), ('number', 'Number'), ('url', 'URL'), ('checkbox', 'Checkbox'), ('checkboxes', 'Checkboxes'), ('dropdown', 'Drop down'), ('radio', 'Radio buttons'), ('date', 'Date'), ('datetime', 'Date/time')], max_length=16, verbose_name='field type'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='help_text',
            field=models.CharField(blank=True, max_length=255, verbose_name='help text'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='label',
            field=models.CharField(help_text='The label of the form field', max_length=255, verbose_name='label'),
        ),
        migrations.AlterField(
            model_name='formfield',
            name='required',
            field=models.BooleanField(verbose_name='required', default=True),
        ),
        migrations.AlterField(
            model_name='formpage',
            name='from_address',
            field=models.CharField(blank=True, max_length=255, verbose_name='from address'),
        ),
        migrations.AlterField(
            model_name='formpage',
            name='subject',
            field=models.CharField(blank=True, max_length=255, verbose_name='subject'),
        ),
        migrations.AlterField(
            model_name='formpage',
            name='to_address',
            field=models.CharField(blank=True, max_length=255, verbose_name='to address', help_text='Optional - form submissions will be emailed to this address'),
        ),
    ]
