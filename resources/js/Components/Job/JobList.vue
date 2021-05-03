<template>
    <ul>
        <li v-for="job in jobs" :key="`job${job.id}`" class="my-4">
            <a
                :href="job.url"
                class="font-semibold inline-flex items-center w-full text-sm text-gray-800 hover:text-gray-600"
            >
                <ChevronRightIcon class="w-6 h-6 font-bold mr-2" />
                <h3>{{ job.title }}</h3>
            </a>
        </li>
    </ul>
</template>

<script>
import { ChevronRightIcon } from "@heroicons/vue/outline";

export default {
    name: "JobList",
    components: {
        ChevronRightIcon,
    },
    props: {
        jobs: Array,
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
