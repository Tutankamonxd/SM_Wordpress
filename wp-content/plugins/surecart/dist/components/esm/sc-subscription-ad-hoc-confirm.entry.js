import { r as registerInstance, h } from './index-745b6bec.js';
import { i as intervalString } from './price-7bb626d0.js';
import { a as addQueryArgs } from './add-query-args-0e2a8393.js';
import './currency-a0c9bff4.js';

const scSubscriptionAdHocConfirmCss = ":host{display:block}";
const ScSubscriptionAdHocConfirmStyle0 = scSubscriptionAdHocConfirmCss;

const ScSubscriptionAdHocConfirm = class {
    constructor(hostRef) {
        registerInstance(this, hostRef);
        this.heading = undefined;
        this.price = undefined;
        this.busy = false;
    }
    async handleSubmit(e) {
        const { ad_hoc_amount } = await e.target.getFormJson();
        this.busy = true;
        return window.location.assign(addQueryArgs(window.location.href, {
            action: 'confirm',
            ad_hoc_amount,
        }));
    }
    render() {
        return (h("sc-dashboard-module", { key: '064aafb249b7ac41cd0544071af1f1bdd007e27f', heading: this.heading || wp.i18n.__('Enter An Amount', 'surecart'), class: "subscription-switch" }, h("sc-card", { key: '0cbff55730e8d72e268cc4d9c2869e678a74f3bb' }, h("sc-form", { key: '232128c45313224961a50c1fc024bf0e87899195', onScSubmit: e => this.handleSubmit(e) }, h("sc-price-input", { key: 'f36fbac007b736cc65fec848a7abd5edfa6e2ff4', label: "Amount", name: "ad_hoc_amount", autofocus: true, required: true }, h("span", { key: '796ef514b8d15e3b711e2784a84cf0b918e0ebd4', slot: "suffix", style: { opacity: '0.75' } }, intervalString(this.price))), h("sc-button", { key: '65609aff83b49dd58f1ae457adcf2b8046e23dda', type: "primary", full: true, submit: true, loading: this.busy }, wp.i18n.__('Next', 'surecart'), " ", h("sc-icon", { key: '4394e72ccf2a40e42bc0b490f5e5a5e38b304947', name: "arrow-right", slot: "suffix" })))), this.busy && h("sc-block-ui", { key: '9a819a30377be1b4801649caeded5a977b5f352e', style: { zIndex: '9' } })));
    }
};
ScSubscriptionAdHocConfirm.style = ScSubscriptionAdHocConfirmStyle0;

export { ScSubscriptionAdHocConfirm as sc_subscription_ad_hoc_confirm };

//# sourceMappingURL=sc-subscription-ad-hoc-confirm.entry.js.map