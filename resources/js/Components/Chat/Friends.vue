<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <TransitionRoot as="template" :show="open" style="z-index: 100000">
        <Dialog
            as="section"
            static
            class="fixed inset-0 overflow-hidden"
            @close="$emit('close')"
            :open="open"
        >
            <div class="absolute inset-0 overflow-hidden">
                <TransitionChild
                    as="template"
                    enter="ease-in-out duration-500"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in-out duration-500"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
                    <TransitionChild
                        as="template"
                        enter="transform transition ease-in-out duration-500 sm:duration-700"
                        enter-from="translate-x-full"
                        enter-to="translate-x-0"
                        leave="transform transition ease-in-out duration-500 sm:duration-700"
                        leave-from="translate-x-0"
                        leave-to="translate-x-full"
                    >
                        <div class="w-screen max-w-md">
                            <div
                                class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll"
                            >
                                <div class="px-4 sm:px-6">
                                    <div
                                        class="flex items-start justify-between"
                                    >
                                        <DialogTitle
                                            class="text-lg font-medium text-gray-900 sticky top-0"
                                        >
                                            Panel title
                                        </DialogTitle>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button
                                                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                @click="$emit('close')"
                                            >
                                                <span class="sr-only"
                                                    >Close panel</span
                                                >
                                                <XIcon
                                                    class="h-6 w-6"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 relative flex-1 px-4 sm:px-6">
                                    <!-- Replace with your content -->
                                    <div class="absolute inset-0 px-4 sm:px-6">
                                        <!--<div-->
                                        <!--    class="h-full border-2 border-dashed border-gray-200"-->
                                        <!--    aria-hidden="true"-->
                                        <!--/>-->
                                        <ul>
                                            <li
                                                v-for="friend in friends"
                                                :key="`friend${friend.id}`"
                                            >
                                                <button
                                                    class="w-full mb-3 font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                                >
                                                    <div>
                                                        <img
                                                            class="h-8 w-8 rounded-full"
                                                            :src="friend.avatar"
                                                            alt=""
                                                        />
                                                    </div>
                                                    <div>
                                                        {{ friend.name }}
                                                        {{ friend.username }}
                                                    </div>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /End replace -->
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
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
import { XIcon } from "@heroicons/vue/outline";

export default {
    name: "Friends",
    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        XIcon,
    },
    props: {
        open: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            friends: [],
        };
    },
    mounted() {
        // axios.get(this.route("messages")).then((response) => {
        //     console.log(response);
        //     this.friends = response.data.friends;
        //     // this.messages = response.data;
        // });
        // this.$inertia.get(
        //     this.route("messages"),
        //     {},
        //     {
        //         preserveState: true,
        //         onSuccess: () => {
        //             window.scrollTo({
        //                 top: 0,
        //                 behavior: "smooth",
        //             });
        //         },
        //     }
        // );
    },
};
</script>
