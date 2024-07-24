import './bootstrap.js';
import './styles/app.css';

import grapesjs from 'grapesjs';
import 'grapesjs/dist/css/grapes.min.css';
import plugin from 'grapesjs-blocks-basic';
import grapesjs_tabs from 'grapesjs-tabs';

document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const landingContent = document.querySelector('meta[name="landing-content"]').getAttribute('content') || '';

    const editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        height: '100%',
        width: 'auto',
        storageManager: {
            type: 'remote',
            autosave: false,
            autoload: false,
            urlStore: '/save-landing',
            urlLoad: '/load-landing',
            params: { _token: csrfToken }
        },
        plugins: [plugin, grapesjs_tabs],
        pluginsOpts: {
            'grapesjs-blocks-basic': {
                flexGrid: true
            },
            'grapesjs-tabs': {}
        }
    });

    if (landingContent) {
        editor.setComponents(landingContent);
    }
});
