<template>
    <Popover class="relative" v-slot="{ open }">
        <PopoverButton
            ref="searchResultButton"
            :class="[
                open ? 'text-gray-900' : 'text-gray-500',
                'hidden group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
            ]"
        >
            <span>Solutions</span>
            <ChevronDownIcon
                :class="[
                    open ? 'text-gray-600' : 'text-gray-400',
                    'ml-2 h-5 w-5 group-hover:text-gray-500',
                ]"
                aria-hidden="true"
            />
        </PopoverButton>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-1"
        >
            <div v-if="typing">
                <div
                    class="bg-black"
                    :class="typing ? 'opacity-30 fixed inset-0' : 'opacity-0'"
                    @click="$emit('close')"
                    style="z-index: 100000"
                />
                <PopoverPanel
                    class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-md sm:px-0"
                    static
                    style="z-index: 10000000"
                >
                    <div
                        class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
                    >
                        <div
                            class="relative grid gap-3 bg-white px-5 py-6 sm:gap-4 sm:p-8"
                        >
                            <inertia-link
                                v-for="result in results"
                                :key="`results${result.id}`"
                                class="bg-gray-100 hover:bg-gray-200 p-2 rounded-lg"
                                :href="
                                    route('show.profile', {
                                        username: result.username,
                                    })
                                "
                            >
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="result.avatar"
                                            alt=""
                                        />
                                    </div>
                                    <div>
                                        <h3
                                            class="text-gray-900 text-sm font-medium truncate"
                                        >
                                            {{ result.name }}
                                        </h3>
                                        <span class="block user-name">
                                            {{ result.username }}</span
                                        >
                                    </div>
                                </div>
                            </inertia-link>
                            <div
                                v-if="results.length === 0 && !searching"
                                class="text-center text-sm my-4 text-gray-600"
                            >
                                <span>No results found.</span>
                            </div>
                            <div
                                v-if="searching"
                                class="text-center text-sm my-4 text-gray-600 flex justify-center"
                            >
                                <loading-icon />
                            </div>
                        </div>
                    </div>
                </PopoverPanel>
            </div>
        </transition>
    </Popover>
</template>

<script>
import {
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
} from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import LoadingIcon from "@/Shared/LoadingIcon";

export default {
    name: "SearchResults",
    props: {
        searching: {
            type: Boolean,
            default: false,
        },
        typing: {
            type: Boolean,
            default: false,
        },
        results: Array,
    },
    watch: {
        typing: {
            handler(val) {
                if (val) {
                    this.bodyScroll(true);
                } else {
                    this.bodyScroll(false);
                }
            },
        },
    },
    components: {
        LoadingIcon,
        Popover,
        PopoverButton,
        PopoverPanel,
        ChevronDownIcon,
        PopoverOverlay,
    },
    methods: {
        bodyScroll(bool) {
            const $body = document.querySelector("body");
            let scrollPosition = 0;
            if (bool) {
                scrollPosition = window.pageYOffset;
                $body.style.overflow = "hidden";
                $body.style.position = "fixed";
                $body.style.top = `-${scrollPosition}px`;
                $body.style.width = "100%";
            } else {
                $body.style.removeProperty("overflow");
                $body.style.removeProperty("position");
                $body.style.removeProperty("top");
                $body.style.removeProperty("width");
                window.scrollTo(0, scrollPosition);
            }
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
