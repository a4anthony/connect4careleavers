<template>
    <div class="p-5">
        <div>
            <button
                type="submit"
                @click="showModal = true"
                class="font-bold inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Add Job/Course
            </button>
        </div>
        <div class="border-b-2 my-4 border-b-width-1"></div>

        <div>
            <div
                class="p-4 bg-gray-100 mb-4 flex items-center rounded-lg"
                v-for="job in jobs"
                :key="`jobs${job.id}`"
            >
                <div class="text-sm text-gray-700 flex-grow mr-2">
                    <span class="block"
                        ><span class="font-bold text-gray-900">Tile: </span>
                        {{ job.title }}</span
                    >
                    <span class="block"
                        ><span class="font-bold text-gray-900">Url: </span>
                        <a :href="job.url">{{ job.url }}</a></span
                    >
                </div>
                <div class="mr-2 w-12 flex-none">
                    <button
                        type="submit"
                        @click="edit(job)"
                        class="font-bold inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Edit
                    </button>
                </div>
                <div class="ml-2 w-6 flex-none">
                    <delete-job :job="job" />
                </div>
            </div>
        </div>
        <job-modal :open="showModal" @close="close" :job="selectedJob" />
    </div>
</template>

<script>
import JobModal from "@/Components/Admin/JobModal";
import JobList from "@/Components/Job/JobList";
import DeleteJob from "@/Components/Admin/DeleteJob";
export default {
    name: "AdminJobs",
    components: { DeleteJob, JobList, JobModal },
    props: {
        jobs: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: "",
                url: "",
            }),
            showModal: false,
            modalText: "",
            selectedJob: null,
        };
    },
    methods: {
        edit(job) {
            this.selectedJob = job;
            this.showModal = true;
        },
        close() {
            this.showModal = false;
            this.selectedJob = null;
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
