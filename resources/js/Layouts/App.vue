<template>
    <div>
        <navigation-bar />
        <alerts />
        <transition name="page">
            <main class="mt-8" v-if="animate" style="min-height: 70vh">
                <slot></slot>
            </main>
        </transition>
        <scroll-to-top />
    </div>
</template>

<script>
import NavigationBar from "@/Shared/NavigationBar";
import Alerts from "@/Shared/Alerts";
import ScrollToTop from "@/Shared/ScrollToTop";
export default {
    name: "App",
    components: { ScrollToTop, Alerts, NavigationBar },
    data() {
        return {
            animate: true,
            currentPage: "",
        };
    },
    mounted() {
        this.currentPage = this.$page.url;
        console.log(this.$page);
    },
    watch: {
        "$page.url": {
            handler(val) {
                console.log(val);
                console.log(this.currentPage);
                if (this.currentPage === val) {
                    this.animate = false;
                    this.animate = true;
                } else {
                    this.currentPage = val;
                    this.animate = false;
                    const that = this;
                    setTimeout(function () {
                        that.animate = true;
                    }, 900);
                }
            },
            deep: true,
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
