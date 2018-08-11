def sort_by_fields(items, fields):
    """
    Sort a list of objects on the given fields. The field list works analogously to
    queryset.order_by(*fields): each field is either a property of the object,
    or is prefixed by '-' (e.g. '-name') to indicate reverse ordering.
    """
    # To get the desired behaviour, we need to order by keys in reverse order
    # See: https://docs.python.org/2/howto/sorting.html#sort-stability-and-complex-sorts
    for key in reversed(fields):
        # Check if this key has been reversed
        reverse = False
        if key[0] == '-':
            reverse = True
            key = key[1:]

        # Sort
        # Use a tuple of (v is not None, v) as the key, to ensure that None sorts before other values,
        # as comparing directly with None breaks on python3
        items.sort(key=lambda x: (getattr(x, key) is not None, getattr(x, key)), reverse=reverse)
