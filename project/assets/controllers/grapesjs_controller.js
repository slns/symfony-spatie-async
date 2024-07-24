// assets/controllers/grapesjs_controller.js
import { Controller } from "@hotwired/stimulus";
import grapesjs from "grapesjs";
import "grapesjs/dist/css/grapes.min.css";
import plugin from "grapesjs-blocks-basic";
import grapesjs_blocks_flexbox from "grapesjs-blocks-flexbox";
import grapesjs_plugin_forms from "grapesjs-plugin-forms";
import grapesjs_plugin_export from "grapesjs-plugin-export";
import grapesjs_custom_code from "grapesjs-custom-code";
import grapesjs_tabs_u from "grapesjs-tabs";
import grapesjs_style_bg from "grapesjs-style-bg";
import grapesjs_navbar from "grapesjs-navbar";
import grapesjs_tooltip from "grapesjs-tooltip";

export default class extends Controller {
    static targets = ["editor"];

    connect() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const landingContent = document.getElementById('landing-content').innerHTML || '';

        const editor = grapesjs.init({
            container: this.editorTarget,
            fromElement: true,
            height: '100vh',
            width: 'auto',
            storageManager: {
                type: 'remote',
                autosave: false,
                autoload: false,
                urlStore: '/save-landing',
                urlLoad: '/load-landing',
                params: { _token: csrfToken }
            },
            plugins: [
                plugin,
                grapesjs_blocks_flexbox,
                grapesjs_plugin_forms,
                grapesjs_plugin_export,
                grapesjs_custom_code,
                grapesjs_tabs_u,
                grapesjs_style_bg,
                grapesjs_navbar,
                grapesjs_tooltip,
            ],
            pluginsOpts: {
                [plugin]: { flexGrid: true },
                [grapesjs_blocks_flexbox]: {},
                [grapesjs_plugin_forms]: {},
                [grapesjs_plugin_export]: {},
                [grapesjs_custom_code]: {},
                [grapesjs_tabs_u]: {},
                [grapesjs_style_bg]: {},
                [grapesjs_navbar]: {},
                [grapesjs_tooltip]: {},
            }
        });

        if (landingContent) {
            editor.setComponents(landingContent);
        }
    }
}
