// TinyMCE
import "tinymce/tinymce";

/* Default icons are required. After that, import custom icons if applicable */
import "tinymce/icons/default/icons";

/* Required TinyMCE components */
import "tinymce/themes/silver/theme";
import "tinymce/models/dom/model";

/* Import a skin (can be a custom skin instead of the default) */
import "tinymce/skins/ui/oxide/skin";

/* Import plugins */
import "tinymce/plugins/advlist";
import "tinymce/plugins/code";
import "tinymce/plugins/emoticons";
import "tinymce/plugins/emoticons/js/emojis";
import "tinymce/plugins/link";
import "tinymce/plugins/lists";
import "tinymce/plugins/table";

// /* content UI CSS is required */
// import contentUiSkinCss from "tinymce/skins/ui/oxide/content.js";

/* The default content CSS can be changed or replaced with appropriate CSS for the editor content. */
// import contentCss from "tinymce/skins/content/default/content.js";

import "./bootstrap";

import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";

// If you use Tailwind
// import "./../../vendor/power-components/livewire-powergrid/dist/tailwind.css";

// If you use Bootstrap 5
import "./../../vendor/power-components/livewire-powergrid/dist/bootstrap5.css";


import flatpickr from "flatpickr";


