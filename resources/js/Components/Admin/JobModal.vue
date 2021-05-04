<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            static
            class="fixed z-10 inset-0 overflow-y-auto"
            @close="$emit('close')"
            :open="open"
            style="z-index: 10000"
        >
            <div
                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-full sm:max-w-lg sm:w-full"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="w-full">
                                <form action="">
                                    <div>
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700"
                                            >Title</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                type="text"
                                                name="title"
                                                id="title"
                                                v-model="form.title"
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                placeholder="Enter job/course title"
                                            />
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700"
                                            >Url</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                type="text"
                                                name="url"
                                                id="url"
                                                v-model="form.url"
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                placeholder="you@example.com"
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                        >
                            <button
                                v-if="job"
                                type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                                :class="{
                                    'opacity-25':
                                        form.title.length === 0 ||
                                        form.url.length === 0,
                                }"
                                :disabled="
                                    form.processing ||
                                    form.title.length === 0 ||
                                    form.url.length === 0
                                "
                                @click="add"
                            >
                                <span
                                    v-if="!form.processing"
                                    class="inline-flex items-center justify-center"
                                >
                                    Update
                                </span>
                                <loading-icon v-else />
                            </button>
                            <button
                                v-else
                                type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                                :class="{
                                    'opacity-25':
                                        form.title.length === 0 ||
                                        form.url.length === 0,
                                }"
                                :disabled="
                                    form.processing ||
                                    form.title.length === 0 ||
                                    form.url.length === 0
                                "
                                @click="add"
                            >
                                <span
                                    v-if="!form.processing"
                                    class="inline-flex items-center justify-center"
                                >
                                    Add
                                </span>
                                <loading-icon v-else />
                            </button>
                            <button
                                type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="$emit('close')"
                                ref="cancelButtonRef"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref } from "vue";
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ExclamationIcon } from "@heroicons/vue/outline";
import LoadingIcon from "@/Shared/LoadingIcon";

export default {
    name: "JobModal",
    components: {
        LoadingIcon,
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        ExclamationIcon,
    },
    props: {
        open: {
            type: Boolean,
            default: false,
        },
        text: String,
        job: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                job_id: null,
                title: "",
                url: "",
            }),
        };
    },
    watch: {
        open: {
            handler(val) {
                if (val && this.job) {
                    this.form = this.$inertia.form({
                        title: this.job.title,
                        url: this.job.url,
                    });
                }
            },
            deep: true,
        },
    },
    mounted() {},
    methods: {
        confirm() {
            this.$emit("confirmed");
        },
        add() {
            this.form.post(this.route("store.jobs"), {
                preserveState: true,
                onFinish: () => {
                    this.form.reset("processing");
                    this.form.reset("title");
                    this.form.reset("url");
                    this.$emit("close");
                },
            });
        },
        edit() {
            this.form.job_id = this.job.id;
            this.form.post(this.route("update.jobs"), {
                preserveState: true,
                onFinish: () => {
                    this.form.reset("processing");
                    this.form.reset("title");
                    this.form.reset("url");
                    this.$emit("close");
                },
            });
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
