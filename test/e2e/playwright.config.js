/**
 * External dependencies
 */
const config = require('@wordpress/scripts/config/playwright.config.js');
config.testDir = './test/e2e/specs';

module.exports = config;
