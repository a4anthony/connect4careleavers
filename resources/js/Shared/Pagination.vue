<template>
    <div
        class="shadow-sm bg-indigo-600 rounded-lg px-4 py-3 flex items-center justify-between border border-gray-200 sm:px-6"
    >
        <div class="flex-1 flex justify-between">
            <div class="flex flex-wrap sm:flex-nowrap">
                <button
                    type="button"
                    @click="$emit('first')"
                    class="font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                >
                    <ChevronLeftIcon
                        class="-ml-0.5 mr-2 h-4 w-4"
                        aria-hidden="true"
                    />
                    First
                </button>
                <button
                    type="button"
                    @click="$emit('prev')"
                    :class="{ 'bg-gray-200': disablePrev }"
                    :disabled="disablePrev"
                    class="mt-4 sm:mt-0 ml-0 sm:ml-4 font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                >
                    <ChevronLeftIcon
                        class="-ml-0.5 mr-2 h-4 w-4"
                        aria-hidden="true"
                    />
                    Previous
                </button>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap justify-end">
                <button
                    type="button"
                    @click="$emit('next')"
                    :class="{ 'bg-gray-200': disableNext }"
                    :disabled="disableNext"
                    class="font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                >
                    Next
                    <ChevronRightIcon
                        class="ml-3 -mr-1 h-5 w-5"
                        aria-hidden="true"
                    />
                </button>
                <button
                    type="button"
                    @click="$emit('last')"
                    class="mt-4 sm:mt-0 ml-0 sm:ml-4 font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                >
                    Last
                    <ChevronRightIcon
                        class="ml-3 -mr-1 h-5 w-5"
                        aria-hidden="true"
                    />
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
export default {
    name: "Pagination",
    components: { ChevronLeftIcon, ChevronRightIcon },
    props: {
        disablePrev: {
            type: Boolean,
            default: false,
        },
        disableNext: {
            type: Boolean,
            default: false,
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
