<template>
    <app :page-title="pageTitle">
        <div class="container mx-auto flex justify-center">
            <div class="px-3 w-full lg:w-2/3">
                <div class="bg-white border rounded-lg mb-4 p-4">
                    <div class="mt-3">
                        <h1 class="text-gray-700 font-bold text-2xl">
                            Jobs & Courses
                        </h1>
                    </div>
                    <div class="border-b-2 my-6 border-b-width-1"></div>
                    <job-list :jobs="jobs" />
                </div>

                <div class="mt-6" v-if="jobs.total > 15">
                    <pagination
                        :disable-prev="jobs.current_page === 1"
                        :disable-next="jobs.last_page === jobs.current_page"
                        @next="next"
                        @prev="prev"
                        @first="first"
                        @last="last"
                    ></pagination>
                </div>
            </div>
        </div>
    </app>
</template>

<script>
import App from "@/Layouts/App";
import { ChevronRightIcon } from "@heroicons/vue/outline";
import Pagination from "@/Shared/Pagination";
import JobList from "@/Components/Job/JobList";

export default {
    name: "Index",
    props: {
        jobs: Object,
        pageTitle: String,
    },
    components: { JobList, Pagination, App, ChevronRightIcon },
    data() {
        return {
            page: 1,
        };
    },
    methods: {
        next() {
            this.$inertia.get(
                this.route(this.route().current()),
                { page: this.jobs.current_page + 1 },
                {
                    preserveState: true,
                    onSuccess: () => {
                        window.scrollTo({
                            top: 0,
                            behavior: "smooth",
                        });
                    },
                }
            );
        },
        prev() {
            this.$inertia.get(
                this.route(this.route().current()),
                { page: this.jobs.current_page - 1 },
                {
                    preserveState: true,
                    onSuccess: () => {
                        window.scrollTo({
                            top: 0,
                            behavior: "smooth",
                        });
                    },
                }
            );
        },
        first() {
            this.$inertia.get(
                this.route(this.route().current()),
                { page: 1 },
                {
                    preserveState: true,
                    onSuccess: () => {
                        window.scrollTo({
                            top: 0,
                            behavior: "smooth",
                        });
                    },
                }
            );
        },
        last() {
            this.$inertia.get(
                this.route(this.route().current()),
                { page: this.jobs.last_page },
                {
                    preserveState: true,
                    onSuccess: () => {
                        window.scrollTo({
                            top: 0,
                            behavior: "smooth",
                        });
                    },
                }
            );
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
