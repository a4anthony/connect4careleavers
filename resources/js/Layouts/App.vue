<template>
    <div>
        <navigation-bar />
        <alerts />
        <main
            class="mt-8 mb-20"
            :class="{ 'absolute top-24 bottom-0 left-0 right-0': onMessages }"
            :style="!onMessages ? { minHeight: '100vh' } : {}"
        >
            <slot></slot>
        </main>
        <scroll-to-top />
        <page-loader :loader="animate" />
    </div>
</template>

<script>
import NavigationBar from "@/Shared/NavigationBar";
import Alerts from "@/Shared/Alerts";
import ScrollToTop from "@/Shared/ScrollToTop";
import PageLoader from "@/Shared/PageLoader";
export default {
    name: "App",
    components: { PageLoader, ScrollToTop, Alerts, NavigationBar },
    data() {
        return {
            animate: false,
            currentPage: "",
        };
    },
    computed: {
        onMessages() {
            return this.route().current() === "messages";
        },
    },
    mounted() {},
    watch: {},
    created() {
        document.addEventListener("inertia:start", this.start);
        document.addEventListener("inertia:finish", this.finish);
    },
    unmounted() {
        document.removeEventListener("inertia:start", this.start);
        document.removeEventListener("inertia:finish", this.finish);
    },
    methods: {
        start(e) {
            if (e.detail.visit.method === "get") {
                this.animate = true;
            }
        },
        finish(e) {
            const that = this;
            if (e.detail.visit.method === "get") {
                setTimeout(function () {
                    that.animate = false;
                }, 100);
            }
        },
    },
};
</script>

<style scoped>
/* durations and timing functions.*/
.page-enter-active,
.page-leave-active {
    transition: all 1s;
}

.page-enter,
.page-leave-active {
    opacity: 0;
}
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
