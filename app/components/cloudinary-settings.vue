<template>
    <form class="uk-form-horizontal uk-margin-large" @submit.prevent="save">
        <div class="uk-modal-header">
            <h1 class="uk-h3">{{ "Cloudinary Settings" | trans }}</h1>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label class="uk-form-label uk-text-left">{{ "Cloud Name" | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" v-model="package.config.cloud_name" required />
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-left">{{ "Api Key" | trans }}</label>
                <div class="uk-form-controls">
                    <input type="password" class="uk-input" v-model="package.config.api_key" required />
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-primary" type="submit">{{ "Save" | trans }}</button>
        </div>
    </form>
</template>

<script>
module.exports = {
    name: "cloudinary",

    settings: true,

    props: ["package"],

    methods: {
        save() {
            this.$http
                .post("admin/system/settings/config", {
                    name: "cloudinary",
                    config: this.package.config,
                })
                .then(function () {
                    this.$notify("Settings saved.", "");
                })
                .catch(function (response) {
                    this.$notify(response.message, "danger");
                })
                .finally(function () {
                    this.$parent.close();
                });
        },
    },
};

window.Extensions.components["cloudinary-settings"] = module.exports;
</script>
