<template>
    <div>
        <div v-if="packageConfig.cloud_name" class="cms-container" style="height: 800px"></div>
        <div v-else class="uk-height-large uk-flex uk-flex-center uk-flex-middle">
            <h4 class="uk-text-muted">{{ "The settings for the plugin are not complete." | tran }}</h4>
        </div>
    </div>
</template>

<script>
const CloudinaryFinder = {
    props: {
        source: Object,
        selected: Array,
        count: Number,
    },

    multiFinder: {
        label: "Cloudinary",
        icon: "packages/greencheap/cloudinary/icon.svg",
        priority: 5,
        padding: false,
    },

    data() {
        return {
            cloudinary: false,
            packageConfig: window.$cloudinary,
        };
    },

    mounted() {
        const ref = this;
        this.cloudinary = cloudinary.openMediaLibrary(
            {
                cloud_name: this.packageConfig.cloud_name,
                api_key: this.packageConfig.api_key,
                remove_header: true,
                multiple: false,
                max_files: 8,
                inline_container: ".cms-container",
            },
            {
                insertHandler: function (data) {
                    data.assets.forEach((asset) => {
                        if (_.hasIn(asset, "derived")) {
                            ref.setImage(asset.derived[0].secure_url);
                            return;
                        }
                        ref.setImage(asset.secure_url);
                        return;
                    });
                },
            }
        );
    },

    methods: {
        loadSearch() {
            this.$emit("recount", res.response.length);
        },

        setImage(src) {
            this.source.src = src;
        },
    },
};
export default CloudinaryFinder;

window.MultiFinder.components["cloudinary"] = CloudinaryFinder;
</script>

<style scoped>
.cms-container .bg-color,
.cms-container .btn-white:active {
    background: #fff;
}
</style>
