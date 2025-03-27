import { r as registerInstance, h, H as Host } from './index-745b6bec.js';
import './watchers-91c4d57e.js';
import { s as state } from './store-4bc13420.js';
import { a as isBusy } from './getters-1899e179.js';
import { t as trackOffer, p as preview } from './mutations-5702cb96.js';
import './watchers-fbf07f32.js';
import './index-06061d4e.js';
import './google-dd89f242.js';
import './currency-a0c9bff4.js';
import './google-a86aa761.js';
import './utils-cd1431df.js';
import './util-50af2a83.js';
import './index-c5a96d53.js';
import './add-query-args-0e2a8393.js';
import './fetch-8ecbbe53.js';
import './remove-query-args-938c53ea.js';
import './mutations-ed6d0770.js';

const scUpsellCss = ":host{display:block}.confirm__icon{margin-bottom:var(--sc-spacing-medium);display:flex;justify-content:center}.confirm__icon-container{background:var(--sc-color-primary-500);width:55px;height:55px;border-radius:999999px;display:flex;align-items:center;justify-content:center;font-size:26px;line-height:1;color:white}";
const ScUpsellStyle0 = scUpsellCss;

const ScUpsell = class {
    constructor(hostRef) {
        registerInstance(this, hostRef);
    }
    componentWillLoad() {
        trackOffer();
        preview();
    }
    render() {
        var _a, _b, _c, _d, _e, _f, _g, _h, _j;
        const manualPaymentMethod = (_a = state.checkout) === null || _a === void 0 ? void 0 : _a.manual_payment_method;
        return (h(Host, { key: '5a5ccb40408bb12b013981123e775bebb69414a1' }, h("slot", { key: 'd4a4fbc31372bf47404d74bd3b642ea3b5ebf359' }), isBusy() && h("sc-block-ui", { key: 'c67cc77f8b58098ba21bcde7eb7f736cc684b324', style: { 'z-index': '30', '--sc-block-ui-position': 'fixed' } }), h("sc-dialog", { key: '17fe9ac372b7a15f70d5750d0c35f310c7e6d3d8', open: state.loading === 'complete', style: { '--body-spacing': 'var(--sc-spacing-xxx-large)' }, noHeader: true, onScRequestClose: e => e.preventDefault() }, h("div", { key: 'd7f66a09a0fa771352e068cc1b84622d62e0e077', class: "confirm__icon" }, h("div", { key: '5f1bd21266ea19d9fe71a100a3c3ca599d86eefe', class: "confirm__icon-container" }, h("sc-icon", { key: '4423780f17684d15821ed498cbe9a5883456793b', name: "check" }))), h("sc-dashboard-module", { key: '81881198ccac737cdc6b8090005e2fd681796267', heading: ((_c = (_b = state === null || state === void 0 ? void 0 : state.text) === null || _b === void 0 ? void 0 : _b.success) === null || _c === void 0 ? void 0 : _c.title) || wp.i18n.__('Thank you!', 'surecart'), style: { '--sc-dashboard-module-spacing': 'var(--sc-spacing-x-large)', 'textAlign': 'center' } }, h("span", { key: '4f39e49eed4878abbc807fe185e0a962a5b948a2', slot: "description" }, ((_e = (_d = state === null || state === void 0 ? void 0 : state.text) === null || _d === void 0 ? void 0 : _d.success) === null || _e === void 0 ? void 0 : _e.description) || wp.i18n.__('Your purchase was successful. A receipt is on its way to your inbox.', 'surecart')), !!(manualPaymentMethod === null || manualPaymentMethod === void 0 ? void 0 : manualPaymentMethod.name) && !!(manualPaymentMethod === null || manualPaymentMethod === void 0 ? void 0 : manualPaymentMethod.instructions) && (h("sc-alert", { key: 'c2d1f31cbd76ec5f6effbba271fcc9aeb8097820', type: "info", open: true, style: { 'text-align': 'left' } }, h("span", { key: '330c419ae8b7386cc12cbe1db62792d20dec4993', slot: "title" }, manualPaymentMethod === null || manualPaymentMethod === void 0 ? void 0 : manualPaymentMethod.name), h("div", { key: '26059fa92fcd82498fa7695e400f608439d24cc5', innerHTML: manualPaymentMethod === null || manualPaymentMethod === void 0 ? void 0 : manualPaymentMethod.instructions }))), h("sc-button", { key: '5a5a00990a9127a957cdf198cd8a37daaef77484', href: (_g = (_f = window === null || window === void 0 ? void 0 : window.scData) === null || _f === void 0 ? void 0 : _f.pages) === null || _g === void 0 ? void 0 : _g.dashboard, size: "large", type: "primary", autofocus: true }, ((_j = (_h = state === null || state === void 0 ? void 0 : state.text) === null || _h === void 0 ? void 0 : _h.success) === null || _j === void 0 ? void 0 : _j.button) || wp.i18n.__('Continue', 'surecart'), h("sc-icon", { key: 'e5e83144788e5345cdf2e2d308eb08f10a9abc44', name: "arrow-right", slot: "suffix" }))))));
    }
};
ScUpsell.style = ScUpsellStyle0;

export { ScUpsell as sc_upsell };

//# sourceMappingURL=sc-upsell.entry.js.map