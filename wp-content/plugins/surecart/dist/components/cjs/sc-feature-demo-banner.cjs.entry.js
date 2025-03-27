'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

const index = require('./index-8acc3c89.js');

const scFeatureDemoBannerCss = ".sc-banner{background-color:var(--sc-color-brand-primary);color:white;display:flex;align-items:center;justify-content:center}.sc-banner>p{font-size:14px;line-height:1;margin:var(--sc-spacing-small)}.sc-banner>p a{color:inherit;font-weight:600;margin-left:10px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;border-bottom:1px solid;padding-bottom:2px}";
const ScFeatureDemoBannerStyle0 = scFeatureDemoBannerCss;

const ScFeatureDemoBanner = class {
    constructor(hostRef) {
        index.registerInstance(this, hostRef);
        this.url = 'https://app.surecart.com/plans';
        this.buttonText = wp.i18n.__('Upgrade Your Plan', 'surecart');
    }
    render() {
        return (index.h("div", { key: 'f76f3a6ce3c112a1572a5ddc5c14200ffa0232b1', class: { 'sc-banner': true } }, index.h("p", { key: '55c8903c032d2d8ddf97d5d42b7843b1fbd48c49' }, index.h("slot", { key: 'e55c69fa34a910589805fa3e33536ed2b7ccd5d3' }, wp.i18n.__('This is a feature demo. In order to use it, you must upgrade your plan.', 'surecart')), index.h("a", { key: '042a93d4abae2f11f48f7dad8e696cdab95d7fc0', href: this.url, target: "_blank" }, index.h("slot", { key: '8cfccdbe5f539e73d6966e4de5c4283d2a78f095', name: "link" }, this.buttonText, " ", index.h("sc-icon", { key: '8db0ecc6b7362efbc52cb7b40934f600052915d3', name: "arrow-right" }))))));
    }
};
ScFeatureDemoBanner.style = ScFeatureDemoBannerStyle0;

exports.sc_feature_demo_banner = ScFeatureDemoBanner;

//# sourceMappingURL=sc-feature-demo-banner.cjs.entry.js.map