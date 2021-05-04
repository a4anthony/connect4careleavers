<template>
    <app :page-title="pageTitle">
        <div class="flex container mx-auto">
            <div class="flex-grow mr-0 sm:mr-2">
                <div class="px-3">
                    <create-post />
                    <div class="border-b-2 my-4 border-b-width-1"></div>
                    <div class="mt-6">
                        <div class="mb-6">
                            <tabs :tabs="tabs" />
                        </div>
                        <feed :feeds="feeds" :user="$page.props.auth.user" />
                    </div>
                </div>
            </div>
            <div class="hidden sm:block w-1/3 flex-none px-3">
                <div class="sticky top-24">
                    <div class="bg-white rounded-lg border shadow-sm">
                        <div
                            class="p-2 bg-indigo-600 rounded-lg rounded-b-none"
                        >
                            <span class="font-bold text-white">Welcome</span>
                        </div>
                        <div class="flex items-center p-4">
                            <div class="mr-2">
                                <inertia-link
                                    :href="
                                        route('show.profile', {
                                            username:
                                                $page.props.auth.user.username,
                                        })
                                    "
                                >
                                    <img
                                        class="h-8 w-8 rounded-full"
                                        :src="$page.props.auth.user.avatar"
                                        alt=""
                                    />
                                </inertia-link>
                            </div>
                            <div>
                                <h3
                                    class="text-gray-900 text-sm font-medium truncate"
                                >
                                    {{ $page.props.auth.user.name }}
                                </h3>
                                <inertia-link
                                    class="block user-name"
                                    :href="
                                        route('show.profile', {
                                            username:
                                                $page.props.auth.user.username,
                                        })
                                    "
                                >
                                    {{ $page.props.auth.user.username }}
                                </inertia-link>

                                <span class="block">
                                    <inertia-link
                                        class="text-sm text-gray-600 font-semibold hover:text-gray-400"
                                        :href="
                                            route('edit.profile', {
                                                username:
                                                    $page.props.auth.user
                                                        .username,
                                            })
                                        "
                                        >Edit profile</inertia-link
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 my-4 border-b-width-1"></div>
                    <div class="bg-white rounded-lg border mt-4 shadow-sm">
                        <div
                            class="p-2 bg-indigo-600 rounded-lg rounded-b-none"
                        >
                            <span class="font-bold text-white"
                                >Jobs & Courses
                            </span>
                        </div>
                        <div class="p-4">
                            <ul>
                                <li
                                    v-for="(job, index) in jobs"
                                    :key="`job${job.id}`"
                                    class="my-1"
                                >
                                    <a
                                        :href="job.url"
                                        class="font-semibold inline-flex items-center w-full text-sm text-gray-800 hover:text-gray-600"
                                    >
                                        <span class="mr-2 font-bold">
                                            {{ index + 1 }}.
                                        </span>
                                        <h3 class="truncate">
                                            {{ job.title }}
                                        </h3>
                                    </a>
                                </li>
                            </ul>
                            <div class="text-center mt-3">
                                <inertia-link
                                    :href="route('all.jobs')"
                                    type="button"
                                    class="font-bold inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    View all
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 my-4 border-b-width-1"></div>
                    <div class="text-gray-800 text-sm mt-4 text-center">
                        &copy;
                        {{ new Date().getFullYear() }} Connect4Careleavers.
                        <br />
                        All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </app>
</template>

<script>
import CreatePost from "@/Shared/CreatePost";

import App from "@/Layouts/App";
import Feed from "@/Shared/Feed";
import Alerts from "@/Shared/Alerts";
import Tabs from "@/Shared/Tabs";

import { ChevronRightIcon } from "@heroicons/vue/outline";
const tabs = [
    {
        name: "Your Feed",
        href: "home",
    },
    {
        name: "Liked Posts",
        href: "likedPosts.home",
    },
];

export default {
    components: { App, Tabs, Alerts, Feed, CreatePost, ChevronRightIcon },
    props: {
        auth: Object,
        feeds: Object,
        jobs: Array,
        pageTitle: String,
    },
    setup() {
        return {
            tabs,
        };
    },
    data() {
        return {};
    },
    computed: {},
    mounted() {},
    methods: {},
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
</style>
