'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

const index = require('./index-8acc3c89.js');

const scHeadingCss = ":host{display:block}.heading{font-family:var(--sc-font-sans);display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between}.heading--small .heading__title{font-size:var(--sc-font-size-small);text-transform:uppercase}.heading__text{width:100%}.heading__title{font-size:var(--sc-font-size-x-large);font-weight:var(--sc-font-weight-bold);line-height:var(--sc-line-height-dense);white-space:normal}.heading__description{font-size:var(--sc-font-size-normal);line-height:var(--sc-line-height-dense);color:var(--sc-color-gray-500)}";
const ScHeadingStyle0 = scHeadingCss;

const ScHeading = class {
    constructor(hostRef) {
        index.registerInstance(this, hostRef);
        this.size = 'medium';
    }
    render() {
        return (index.h("div", { key: '1211cf08fc5b135b73d756d166040975bf72234a', part: "base", class: {
                'heading': true,
                'heading--small': this.size === 'small',
                'heading--medium': this.size === 'medium',
                'heading--large': this.size === 'large',
            } }, index.h("div", { key: 'a4865e2fa2765c827d7e4310344b03bfbfeb6768', class: { heading__text: true } }, index.h("div", { key: '8d2be6d0aeb80c54809d8289f48107c47dbf4376', class: "heading__title", part: "title" }, index.h("slot", { key: '5d94fce9c489f05d83b47cdfa6be08477636c0e2' })), index.h("div", { key: 'bc7679e5d03740b2d72c405bab7eac10456a4ba0', class: "heading__description", part: "description" }, index.h("slot", { key: '2b52741b6e98c42688bce72f89a01dfd4429ba3c', name: "description" }))), index.h("slot", { key: '13a14d39e385af1ee47346d9b8f7f92d816f88f9', name: "end" })));
    }
    get el() { return index.getElement(this); }
};
ScHeading.style = ScHeadingStyle0;

const ScOrderConfirmComponentsValidator = class {
    constructor(hostRef) {
        index.registerInstance(this, hostRef);
        this.checkout = undefined;
        this.hasManualInstructions = undefined;
    }
    handleOrderChange() {
        var _a;
        if ((_a = this.checkout) === null || _a === void 0 ? void 0 : _a.manual_payment) {
            this.addManualPaymentInstructions();
        }
    }
    addManualPaymentInstructions() {
        var _a, _b;
        if (this.hasManualInstructions)
            return;
        const details = this.el.shadowRoot
            .querySelector('slot')
            .assignedElements({ flatten: true })
            .find(element => element.tagName === 'SC-ORDER-CONFIRMATION-DETAILS');
        const address = document.createElement('sc-order-manual-instructions');
        (_b = (_a = details === null || details === void 0 ? void 0 : details.parentNode) === null || _a === void 0 ? void 0 : _a.insertBefore) === null || _b === void 0 ? void 0 : _b.call(_a, address, details);
        this.hasManualInstructions = true;
    }
    componentWillLoad() {
        this.hasManualInstructions = !!this.el.querySelector('sc-order-manual-instructions');
    }
    render() {
        return index.h("slot", { key: '7e2dfbd843bf6a068d9f7c7f6aa06c31a91508a3' });
    }
    get el() { return index.getElement(this); }
    static get watchers() { return {
        "checkout": ["handleOrderChange"]
    }; }
};

exports.sc_heading = ScHeading;
exports.sc_order_confirm_components_validator = ScOrderConfirmComponentsValidator;

//# sourceMappingURL=sc-heading_2.cjs.entry.js.map