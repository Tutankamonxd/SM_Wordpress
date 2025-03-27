import { r as registerInstance, h } from './index-745b6bec.js';

const scProvisionalBannerCss = ".sc-banner{background-color:var(--sc-color-brand-primary);color:white;display:flex;align-items:center;justify-content:center}.sc-banner>p{font-size:14px;line-height:1;margin:var(--sc-spacing-small)}.sc-banner>p a{color:inherit;font-weight:600;margin-left:10px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;border-bottom:1px solid;padding-bottom:2px}";
const ScProvisionalBannerStyle0 = scProvisionalBannerCss;

const ScProvisionalBanner = class {
    constructor(hostRef) {
        registerInstance(this, hostRef);
        this.claimUrl = '';
    }
    render() {
        return (h("div", { key: '528aa9773968db3e122de3ff4f12f10555722fd1', class: { 'sc-banner': true } }, h("p", { key: 'a1d9d4cd3b62c70ae92f8edeedbd9b86199e78e1' }, wp.i18n.__('Complete your store setup to go live.', 'surecart'), h("a", { key: 'a6b4419d0e8408d2a490ac11b3c286f51aacc780', href: this.claimUrl }, wp.i18n.__('Complete Setup', 'surecart'), " ", h("sc-icon", { key: '01d1214341ffc9fef105eb8231ad833bc2e52d4f', name: "arrow-right" })))));
    }
};
ScProvisionalBanner.style = ScProvisionalBannerStyle0;

export { ScProvisionalBanner as sc_provisional_banner };

//# sourceMappingURL=sc-provisional-banner.entry.js.map