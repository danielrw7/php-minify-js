# php-minify-js
A simple tool to dynamically combine and minify multiple javascript files using Uglify.js

## Dependencies
1. [node.js](https://github.com/joyent/node) - [Here](https://github.com/joyent/node/wiki/installing-node.js-via-package-manager) is a guide to install node.js using common package managers.

## Installation
1. Run the command `git clone --branch=master https://github.com/danielrw7/php-minify-js.git min` in the root of your javascript directory.

Now you can minify multiple javascript files by comma seperating files in the query string: `[jsdir]/min/?f=file1.js,file2.js`
