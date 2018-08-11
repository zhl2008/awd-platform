from datetime import datetime, time, timedelta
import hashlib


def export_event(event, format='ical'):
    # Only ical format supported at the moment
    if format != 'ical':
        return

    # Begin event
    # VEVENT format: http://www.kanzaki.com/docs/ical/vevent.html
    ical_components = [
        'BEGIN:VCALENDAR',
        'VERSION:2.0',
        'PRODID:-//Torchbox//wagtail//EN',
    ]

    # Work out number of days the event lasts
    if event.date_to is not None:
        days = (event.date_to - event.date_from).days + 1
    else:
        days = 1

    for day in range(days):
        # Get date
        date = event.date_from + timedelta(days=day)

        # Get times
        if event.time_from is not None:
            start_time = event.time_from
        else:
            start_time = time.min
        if event.time_to is not None:
            end_time = event.time_to
        else:
            end_time = time.max

        # Combine dates and times
        start_datetime = datetime.combine(
            date,
            start_time
        )
        end_datetime = datetime.combine(date, end_time)

        def add_slashes(string):
            string.replace('"', '\\"')
            string.replace('\\', '\\\\')
            string.replace(',', '\\,')
            string.replace(':', '\\:')
            string.replace(';', '\\;')
            string.replace('\n', '\\n')
            return string

        # Make a uid
        event_string = event.url + str(start_datetime)
        uid = hashlib.sha1(event_string.encode('utf-8')).hexdigest() + '@wagtaildemo'

        # Make event
        ical_components.extend([
            'BEGIN:VEVENT',
            'UID:' + add_slashes(uid),
            'URL:' + add_slashes(event.url),
            'DTSTAMP:' + start_time.strftime('%Y%m%dT%H%M%S'),
            'SUMMARY:' + add_slashes(event.title),
            'DESCRIPTION:' + add_slashes(event.search_description),
            'LOCATION:' + add_slashes(event.location),
            'DTSTART;TZID=Europe/London:' + start_datetime.strftime('%Y%m%dT%H%M%S'),
            'DTEND;TZID=Europe/London:' + end_datetime.strftime('%Y%m%dT%H%M%S'),
            'END:VEVENT',
        ])

    # Finish event
    ical_components.extend([
        'END:VCALENDAR',
    ])

    # Join components
    return '\r'.join(ical_components)

