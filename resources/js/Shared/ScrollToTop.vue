<template>
    <div>
        <button
            class="scroll-to-top--btn hidden font-bold inline-flex items-center border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            id="scroll-to-top"
            ref="scrollToTop"
            @click="scrollToTop"
        >
            <ArrowNarrowUpIcon class="h-5 w-5" />
        </button>
    </div>
</template>

<script>
import { ArrowNarrowUpIcon } from "@heroicons/vue/solid";
export default {
    name: "ScrollToTop",
    components: {
        ArrowNarrowUpIcon,
    },
    methods: {
        scrollToTop() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "smooth",
            });
        },
        handleScroll() {
            if (window.scrollY > 400) {
                this.$refs.scrollToTop.classList.remove("hidden");
                this.$refs.scrollToTop.classList.add("visible");
            } else {
                this.$refs.scrollToTop.classList.remove("visible");
                this.$refs.scrollToTop.classList.add("hidden");
            }
        },
    },
    created() {
        window.addEventListener("scroll", this.handleScroll);
    },
    destroyed() {
        window.removeEventListener("scroll", this.handleScroll);
    },
};
</script>

<style scoped>
.visible {
    visibility: visible;
    opacity: 1;
    transition: opacity 0.2s linear;
}
.hidden {
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s 0.2s, opacity 0.2s linear;
}
.scroll-to-top--btn {
    z-index: 100;
    position: fixed;
    bottom: 20px;
    right: 40px;
    opacity: 0.85;
    color: #ffff !important;
    padding: 15px 15px;
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
    .scroll-to-top--btn {
        right: 20px;
    }
}
/* small mobile :576px. */
@media (min-width: 576px) and (max-width: 767px) {
    .scroll-to-top--btn {
        right: 20px;
    }
}
/* extra small mobile 320px. */
@media (max-width: 575px) {
    .scroll-to-top--btn {
        right: 20px;
    }
}
/* Large Mobile :480px. */
@media only screen and (min-width: 480px) and (max-width: 575px) {
    .scroll-to-top--btn {
        right: 20px;
    }
}
@media only screen and (max-width: 575px) and (min-width: 480px) {
    .scroll-to-top--btn {
        right: 20px;
    }
}
</style>
