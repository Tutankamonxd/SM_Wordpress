'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

const index = require('./index-8acc3c89.js');

const scEmptyCss = ":host{display:block}.empty{display:flex;flex-direction:column;align-items:center;padding:var(--sc-spacing-large);text-align:center;gap:var(--sc-spacing-small);color:var(--sc-empty-color, var(--sc-color-gray-500))}.empty sc-icon{font-size:var(--sc-font-size-xx-large);color:var(--sc-empty-icon-color, var(--sc-color-gray-700))}";
const ScEmptyStyle0 = scEmptyCss;

const ScEmpty = class {
    constructor(hostRef) {
        index.registerInstance(this, hostRef);
        this.icon = undefined;
    }
    render() {
        return (index.h("div", { key: 'd0f90ad9757240949ffc78e70297e6bcde1f9593', part: "base", class: "empty" }, !!this.icon && index.h("sc-icon", { key: '493c58899f1fd5601641da99dc8e419f191dc5ff', exportparts: "base:icon", name: this.icon }), index.h("slot", { key: 'def8d4d882fa19d9d9545c91d158773e1c76fd38' })));
    }
};
ScEmpty.style = ScEmptyStyle0;

exports.sc_empty = ScEmpty;

//# sourceMappingURL=sc-empty.cjs.entry.js.map