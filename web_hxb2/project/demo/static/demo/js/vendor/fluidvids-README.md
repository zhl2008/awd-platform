# FluidVids.js [![Build Status](https://travis-ci.org/toddmotto/fluidvids.png)](https://travis-ci.org/toddmotto/fluidvids)

FluidVids is a raw JavaScript solution for responsive and fluid YouTube and Vimeo video embeds. It's extremely lightweight, and comes with a minified version for production environments. FluidVids comes preconfigured to make YouTube and Vimeo videos fluid, but you can add more as you please. You don't need to call FluidVids, it will just work its magic on video embeds automatically.

## Demo
Check out a [demo of FluidVids](http://toddmotto.com/labs/fluidvids).

## Installing with Bower
To install FluidVids into your project using Bower, use the GitHub repository hook:

```
bower install https://github.com/toddmotto/fluidvids.git
```

## Manual installation
Drop your files into your required folders, make sure you're using the files from the `dist` folder, which is the compiled production-ready code. Ensure you place the script before the closing `</body>` tag so the DOM tree is populated when the script runs.
	
```html
<body>
	<!-- html content above -->
	<script src="dist/fluidvids.js"></script>
</body>
```

## Scaffolding
Project files and folder structure.

```
├── dist/
│   ├── fluidvids.js
│   └── fluidvids.min.js
├── src/
│   └── fluidvids.js
├── .editorconfig
├── .gitignore
├── .jshintrc
├── .travis.yml
├── Gruntfile.js
├── config.json
└── package.json
```

## Grunt tasks
FluidVids comes pre-configured with `Gruntfile.js` which contains all of Grunt's tasks. These tasks are `grunt-contrib-concat` for concatenating files, `grunt-contrib-jshint` for JSHinting the project files, `grunt-contrib-uglify` for minifying the code. The hidden file `.jshintrc` contains the configuration for the JSHint tests.

## Adding more video players
FluidVids use a Regular Expression and searches the `src=""` attribute of any `iframe` tags on the page. If the RegExp matches the attribute, FluidVids will then do it's thing and make your videos responsive.

Here's the line you'll need to change:

```javascript
players = /www.youtube.com|player.vimeo.com/;
```

The dividing `|` operator is essentially 'or' in RegExp. For instance, if you wanted to add the no cookies version of YouTube, you could action the following:

```javascript
players = /www.youtube.com|www.youtube-nocookie.com|player.vimeo.com/;
```

## License
MIT license