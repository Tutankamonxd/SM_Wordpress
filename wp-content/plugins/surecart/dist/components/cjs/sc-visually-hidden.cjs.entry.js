'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

const index = require('./index-8acc3c89.js');

const scVisuallyHiddenCss = ":host(:not(:focus-within)){position:absolute !important;width:1px !important;height:1px !important;clip:rect(0 0 0 0) !important;clip-path:inset(50%) !important;border:none !important;overflow:hidden !important;white-space:nowrap !important;padding:0 !important}";
const ScVisuallyHiddenStyle0 = scVisuallyHiddenCss;

const ScVisuallyHidden = class {
    constructor(hostRef) {
        index.registerInstance(this, hostRef);
    }
    render() {
        return index.h("slot", { key: '9c4d3ebd90b25443e5ed580011f61ff209683ad0' });
    }
};
ScVisuallyHidden.style = ScVisuallyHiddenStyle0;

exports.sc_visually_hidden = ScVisuallyHidden;

//# sourceMappingURL=sc-visually-hidden.cjs.entry.js.map