<template>
    <div class="flex container mx-auto">
        <div class="flex-grow mr-0 sm:mr-2">
            <div class="px-3">
                <create-post />
                <div class="border-b-2 my-4 border-b-width-1"></div>
                <div class="mt-6">
                    <div class="mb-6">
                        <tabs :tabs="tabs" />
                    </div>
                    <feed
                        :feeds="posts"
                        @next-page="nextPage"
                        :user="$page.props.auth.user"
                    />
                </div>
            </div>
        </div>
        <div class="hidden sm:block w-1/3 flex-none px-3">
            <div class="sticky top-24">
                <div class="bg-white rounded-lg border shadow-sm">
                    <div class="p-2 bg-indigo-600 rounded-lg rounded-b-none">
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
                                    href="/edit"
                                    >Edit profile</inertia-link
                                >
                            </span>
                        </div>
                    </div>
                </div>
                <div class="border-b-2 my-4 border-b-width-1"></div>
                <div class="bg-white rounded-lg border mt-4 shadow-sm">
                    <div class="p-2 bg-indigo-600 rounded-lg rounded-b-none">
                        <span class="font-bold text-white"
                            >Jobs & Courses
                        </span>
                    </div>
                    <div class="p-4">
                        <ul>
                            <li v-for="job in 5" class="my-1">
                                <a
                                    href="/"
                                    class="d-block w-full text-sm text-blue-800 text-blue-600"
                                    >Job {{ job }}</a
                                >
                            </li>
                        </ul>
                        <div class="text-center mt-3">
                            <button
                                type="button"
                                class="font-bold inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                View all
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-b-2 my-4 border-b-width-1"></div>
                <div class="text-gray-800 text-sm mt-4 text-center">
                    &copy; {{ new Date().getFullYear() }} Connect4Careleavers.
                    <br />
                    All rights reserved.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CreatePost from "@/Shared/CreatePost";
const user = {
    name: "Chelsea Hagon",
    email: "chelseahagon@example.com",
    imageUrl:
        "https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};
import App from "@/Layouts/App";
import Feed from "@/Shared/Feed";
import Alerts from "@/Shared/Alerts";
import Tabs from "@/Shared/Tabs";

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
    components: { Tabs, Alerts, Feed, CreatePost },
    layout: App,
    props: {
        auth: Object,
        feeds: Object,
    },
    setup() {
        return {
            user,
            tabs,
        };
    },
    data() {
        return {
            posts: [],
            page: 1,
        };
    },
    computed: {
        postsFromStorage() {
            // console.log(localStorage.getItem("homePost"));
            const postsFromStorage = localStorage.getItem("homePost");
            console.log(JSON.parse(postsFromStorage));
            return JSON.parse(postsFromStorage);
        },
    },
    mounted() {
        console.log("mounted");
        // console.log(localStorage.getItem("homePost"));
        console.log(this.postsFromStorage);
        const postsFromStorage = localStorage.getItem("homePost");
        // console.log(JSON.parse(postsFromStorage));
        if (this.feeds.current_page === 1) {
            localStorage.removeItem("homePost");
            this.posts = this.feeds.data;
        } else if (postsFromStorage) {
            console.log(JSON.parse(postsFromStorage));
            this.posts = JSON.parse(postsFromStorage);
        }

        this.page = this.feeds.current_page;

        // this.posts = this.feeds.data;
        // this.page = 2;
        // localStorage.setItem("homePost", JSON.stringify(this.posts));
    },
    methods: {
        nextPage() {
            console.log("here");
            this.$inertia.get(
                this.route("home"),
                { page: this.page + 1 },
                {
                    replace: true,
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: (res) => {
                        res.props.feeds.data.forEach((post) => {
                            this.posts.push(post);
                        });
                        localStorage.setItem(
                            "homePost",
                            JSON.stringify(this.posts)
                        );
                    },
                }
            );
        },
    },
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
