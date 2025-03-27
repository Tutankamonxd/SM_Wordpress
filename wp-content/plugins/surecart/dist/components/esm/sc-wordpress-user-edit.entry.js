import { r as registerInstance, h } from './index-745b6bec.js';
import { a as apiFetch } from './fetch-8ecbbe53.js';
import './add-query-args-0e2a8393.js';
import './remove-query-args-938c53ea.js';

const scWordpressUserEditCss = ":host{display:block;position:relative}.customer-details{display:grid;gap:0.75em}";
const ScWordpressUserEditStyle0 = scWordpressUserEditCss;

const ScWordPressUserEdit = class {
    constructor(hostRef) {
        registerInstance(this, hostRef);
        this.heading = undefined;
        this.successUrl = undefined;
        this.user = undefined;
        this.loading = undefined;
        this.error = undefined;
    }
    renderEmpty() {
        return h("slot", { name: "empty" }, wp.i18n.__('User not found.', 'surecart'));
    }
    async handleSubmit(e) {
        this.loading = true;
        try {
            const { email, first_name, last_name, name } = await e.target.getFormJson();
            await apiFetch({
                path: `wp/v2/users/me`,
                method: 'PATCH',
                data: {
                    first_name,
                    last_name,
                    email,
                    name,
                },
            });
            if (this.successUrl) {
                window.location.assign(this.successUrl);
            }
            else {
                this.loading = false;
            }
        }
        catch (e) {
            this.error = (e === null || e === void 0 ? void 0 : e.message) || wp.i18n.__('Something went wrong', 'surecart');
            this.loading = false;
        }
    }
    render() {
        var _a, _b, _c, _d;
        return (h("sc-dashboard-module", { key: 'a422ba1c2c1db4ed6e679a7df550166caed0c3e2', class: "account-details", error: this.error }, h("span", { key: '8b2162a34f54e40b4c2ae5b5e052b854497cbea3', slot: "heading" }, this.heading || wp.i18n.__('Account Details', 'surecart'), " "), h("sc-card", { key: 'de88b6807a5421cf9e609ad3a53563f8867bb4ca' }, h("sc-form", { key: 'cf27c3856c9d83654901e62ddc8d10e9bd0b70b3', onScFormSubmit: e => this.handleSubmit(e) }, h("sc-input", { key: 'dc6a23f37ec0f66bc62c752286c7931eb1b9050d', label: wp.i18n.__('Account Email', 'surecart'), name: "email", value: (_a = this.user) === null || _a === void 0 ? void 0 : _a.email, required: true }), h("sc-columns", { key: '2984ad09bac241bf613b2c1829f71cd339c13271', style: { '--sc-column-spacing': 'var(--sc-spacing-medium)' } }, h("sc-column", { key: '9dcfc93f2f09eb6fa1892542e13a100015af79a4' }, h("sc-input", { key: '8d7e7aa6283d33846754ed1ceb7440e092b86b06', label: wp.i18n.__('First Name', 'surecart'), name: "first_name", value: (_b = this.user) === null || _b === void 0 ? void 0 : _b.first_name })), h("sc-column", { key: 'c4b9439106b37d6efe311e73498f66c77d43ba87' }, h("sc-input", { key: 'c28492cf80de562e6ff1bfe214082f988f662c8a', label: wp.i18n.__('Last Name', 'surecart'), name: "last_name", value: (_c = this.user) === null || _c === void 0 ? void 0 : _c.last_name }))), h("sc-input", { key: '6e9452110a8bfaa8a4eaf30baeaa84261643bfeb', label: wp.i18n.__('Display Name', 'surecart'), name: "name", value: (_d = this.user) === null || _d === void 0 ? void 0 : _d.display_name }), h("div", { key: 'a32f6a1a72b1491da99aa9dfdd2af470a8e0aa5f' }, h("sc-button", { key: '04b889c2844159f03c9da35e88d8f0f776201ef1', type: "primary", full: true, submit: true }, wp.i18n.__('Save', 'surecart'))))), this.loading && h("sc-block-ui", { key: 'c4532c6c5190036149955417180b03f82e476de0', spinner: true })));
    }
};
ScWordPressUserEdit.style = ScWordpressUserEditStyle0;

export { ScWordPressUserEdit as sc_wordpress_user_edit };

//# sourceMappingURL=sc-wordpress-user-edit.entry.js.map