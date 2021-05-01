<template>
    <div
        class="container mx-auto fixed top-20 mt-2"
        v-if="show"
        style="z-index: 100"
    >
        <div class="shadow-sm mx-3 p-3 flex rounded-md bg-green-600">
            <div class="flex-shrink-0">
                <CheckCircleIcon
                    class="h-5 w-5 text-green-200"
                    aria-hidden="true"
                />
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-50">
                    {{ $page.props.flash.success }}
                </p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button
                        type="button"
                        @click="clear"
                        class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600"
                    >
                        <span class="sr-only">Dismiss</span>
                        <XIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { CheckCircleIcon, XIcon } from "@heroicons/vue/solid";

export default {
    name: "Alerts",
    components: {
        CheckCircleIcon,
        XIcon,
    },
    props: {
        text: String,
    },
    data() {
        return {
            show: false,
            msg: "",
        };
    },
    watch: {
        "$page.props.flash.success": {
            handler(val) {
                if (val) {
                    const that = this;
                    this.show = true;
                    this.t = setInterval(function () {
                        that.show = false;
                    }, 5000);
                }
            },
            deep: true,
        },
    },
    mounted() {
        // // if (this.$page.props.flash.success) {
        // this.show = true;
        // // }
        // const that = this;
        // this.t = setInterval(function () {
        //     that.show = false;
        // }, 50000);
    },
    methods: {
        clear() {
            const that = this;
            that.show = false;
            clearInterval(this.t);
        },
    },
};
</script>

<style scoped>
/* (1366x768) WXGA Display */

@media screen and (min-width: 1366px) and (max-width: 1919px) {
}

@media (min-width: 1198px) and (max-width: 1365.9px) {
}

/* Normal desktop :992px. */

@media (min-width: 992px) and (max-width: 1197px) {
}

/* Normal desktop :991px. */

@media (min-width: 768px) and (max-width: 991px) {
}

/* small mobile :576px. */

@media (min-width: 576px) and (max-width: 767px) {
}

/* extra small mobile 320px. */

@media (max-width: 575px) {
}

/* Large Mobile :480px. */

@media only screen and (min-width: 480px) and (max-width: 575px) {
}

@media only screen and (max-width: 575px) and (min-width: 480px) {
}
</style>
