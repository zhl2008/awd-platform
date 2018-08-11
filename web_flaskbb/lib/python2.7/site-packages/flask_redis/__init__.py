try:
    import redis
except ImportError:
    # We can allow custom provider only usage without redis-py being installed
    redis = None

__all__ = ('FlaskRedis', )
__version__ = '0.3.0'


class FlaskRedis(object):

    def __init__(self, app=None, strict=True, config_prefix='REDIS', **kwargs):
        self._redis_client = None
        self.provider_class = redis.StrictRedis if strict else redis.Redis
        self.provider_kwargs = kwargs
        self.config_prefix = config_prefix

        if app is not None:
            self.init_app(app)

    @classmethod
    def from_custom_provider(cls, provider, app=None, **kwargs):
        assert provider is not None, 'your custom provider is None, come on'

        # We never pass the app parameter here, so we can call init_app
        # ourselves later, after the provider class has been set
        instance = cls(**kwargs)

        instance.provider_class = provider
        if app is not None:
            instance.init_app(app)
        return instance

    def init_app(self, app, **kwargs):
        redis_url = app.config.get(
            '{0}_URL'.format(self.config_prefix), 'redis://localhost:6379/0'
        )

        self.provider_kwargs.update(kwargs)
        self._redis_client = self.provider_class.from_url(
            redis_url, **self.provider_kwargs
        )

        if not hasattr(app, 'extensions'):
            app.extensions = {}
        app.extensions[self.config_prefix.lower()] = self

    def __getattr__(self, name):
        return getattr(self._redis_client, name)

    def __getitem__(self, name):
        return self._redis_client[name]

    def __setitem__(self, name, value):
        self._redis_client[name] = value

    def __delitem__(self, name):
        del self._redis_client[name]
