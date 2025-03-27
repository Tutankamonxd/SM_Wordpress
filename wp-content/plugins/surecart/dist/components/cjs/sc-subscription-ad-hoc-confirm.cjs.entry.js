'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

const index = require('./index-8acc3c89.js');
const price = require('./price-ca4a4318.js');
const addQueryArgs = require('./add-query-args-49dcb630.js');
require('./currency-71fce0f0.js');

const scSubscriptionAdHocConfirmCss = ":host{display:block}";
const ScSubscriptionAdHocConfirmStyle0 = scSubscriptionAdHocConfirmCss;

const ScSubscriptionAdHocConfirm = class {
    constructor(hostRef) {
        index.registerInstance(this, hostRef);
        this.heading = undefined;
        this.price = undefined;
        this.busy = false;
    }
    async handleSubmit(e) {
        const { ad_hoc_amount } = await e.target.getFormJson();
        this.busy = true;
        return window.location.assign(addQueryArgs.addQueryArgs(window.location.href, {
            action: 'confirm',
            ad_hoc_amount,
        }));
    }
    render() {
        return (index.h("sc-dashboard-module", { key: '064aafb249b7ac41cd0544071af1f1bdd007e27f', heading: this.heading || wp.i18n.__('Enter An Amount', 'surecart'), class: "subscription-switch" }, index.h("sc-card", { key: '0cbff55730e8d72e268cc4d9c2869e678a74f3bb' }, index.h("sc-form", { key: '232128c45313224961a50c1fc024bf0e87899195', onScSubmit: e => this.handleSubmit(e) }, index.h("sc-price-input", { key: 'f36fbac007b736cc65fec848a7abd5edfa6e2ff4', label: "Amount", name: "ad_hoc_amount", autofocus: true, required: true }, index.h("span", { key: '796ef514b8d15e3b711e2784a84cf0b918e0ebd4', slot: "suffix", style: { opacity: '0.75' } }, price.intervalString(this.price))), index.h("sc-button", { key: '65609aff83b49dd58f1ae457adcf2b8046e23dda', type: "primary", full: true, submit: true, loading: this.busy }, wp.i18n.__('Next', 'surecart'), " ", index.h("sc-icon", { key: '4394e72ccf2a40e42bc0b490f5e5a5e38b304947', name: "arrow-right", slot: "suffix" })))), this.busy && index.h("sc-block-ui", { key: '9a819a30377be1b4801649caeded5a977b5f352e', style: { zIndex: '9' } })));
    }
};
ScSubscriptionAdHocConfirm.style = ScSubscriptionAdHocConfirmStyle0;

exports.sc_subscription_ad_hoc_confirm = ScSubscriptionAdHocConfirm;

//# sourceMappingURL=sc-subscription-ad-hoc-confirm.cjs.entry.js.map