symfony/webpack-encore-bundle  instructions:

* Install NPM and run: `npm install`

* Compile your assets: `npm run dev`

* Or start the development server: `npm run watch`

### If error when build with `npm run watch`
```bash
# Remove AssetMapper & Turbo/Stimulus temporarly
composer remove symfony/ux-turbo symfony/asset-mapper symfony/stimulus-bundle

# Add Webpack Encore and Turbo/Stimulus back
composer require symfony/webpack-encore-bundle symfony/ux-turbo symfony/stimulus-bundle

# Install and build assets
npm install -fr
npm run watch
```
