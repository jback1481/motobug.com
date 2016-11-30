# motobug.com

This application is my personal web site, and playground for new things I want to fiddle with.

### Version
0.0.1

### Tech

motobug.com uses these open source projects to work properly:
* [jQuery] - For our base javascript foundation
* [jQuery Validate] - For the backend form validation

// Make sure node is up to date
sudo npm update -g npm

// Install grunt
sudo npm install -g grunt-cli

// Install the foundation CLI
sudo npm install -g foundation-cli

// Configure Grunt and Foundation
touch Gruntfile.js
npm init
bower init

// Add the dependency to bower.json
"dependencies": {
    "foundation": "zurb/bower-foundation"
}

// Run the install for npm and bower
npm install
bower install