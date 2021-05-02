<template>
    <div class="preloader-wrap" ref="loader" :class="loader ? '' : 'fade'">
        <div class="animate-spin spinner">
            <RefreshIcon class="h-10 w-10 text-indigo-700" />
        </div>
    </div>
</template>

<script>
import Logo from "@/Shared/Logo";
import { RefreshIcon } from "@heroicons/vue/outline";
export default {
    name: "PageLoader",
    components: { RefreshIcon },
    props: {
        loader: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            logo: "",
        };
    },
    watch: {
        loader() {
            const that = this;
            if (!this.loader) {
                setTimeout(function () {
                    that.$refs.loader.classList.add("hidden");
                }, 150);
            }
        },
    },
    created() {},
    mounted() {
        console.log(this.loader);
        if (!this.loader) {
            this.$refs.loader.classList.add("hidden");
        }
    },
};
</script>

<style scoped>
.hidden {
    display: none !important;
}
.preloader-wrap {
    position: fixed;
}
.preloader-wrap {
    /*z-index: 99999;*/
    z-index: 999;
    height: 100%;
    width: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    background: #fff;
    top: 0;
    left: 0;
}
.spinner {
    width: 40px;
    height: 40px;
    margin: 100px auto;
    border-radius: 100%;
    /*-webkit-animation: sk-scaleout 1s infinite ease-in-out;*/
    /*animation: sk-scaleout 1s infinite ease-in-out;*/
}

@-webkit-keyframes sk-scaleout {
    0% {
        -webkit-transform: scale(0);
    }
    100% {
        -webkit-transform: scale(1);
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    }
}

@keyframes sk-scaleout {
    0% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    }
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
