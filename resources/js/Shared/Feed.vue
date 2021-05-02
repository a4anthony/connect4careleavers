<template>
    <div>
        <div
            v-for="feed in feeds.data"
            :id="`feed${feed.id}`"
            class="bg-white border rounded-lg mb-4 p-4"
        >
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="mr-2">
                        <inertia-link
                            :href="
                                route('show.profile', {
                                    username: feed.author.username,
                                })
                            "
                        >
                            <img
                                class="h-8 w-8 rounded-full"
                                :src="feed.author.avatar"
                                alt=""
                            />
                        </inertia-link>
                    </div>
                    <div>
                        <inertia-link
                            class="block user-name"
                            :href="
                                route('show.profile', {
                                    username: feed.author.username,
                                })
                            "
                        >
                            {{ feed.author.username }}
                        </inertia-link>
                        <span class="block text-xs text-gray-700">
                            {{ feed.created_at }}
                        </span>
                    </div>
                </div>
                <div v-if="$page.props.auth.user.id === feed.author.id">
                    <delete-post :feed="feed" />
                </div>
            </div>
            <div class="border-b-2 my-4 border-b-width-1"></div>
            <div class="flex flex-wrap-reverse sm:flex-nowrap">
                <div
                    class="mr-3 mt-3 sm:mt-0 w-full lg:w-1/2"
                    v-if="feed.image"
                >
                    <img
                        class="rounded-md shadow-sm"
                        :src="feed.image"
                        alt="shared image"
                    />
                </div>
                <span class="text-gray-800 text-sm">{{ feed.body }}</span>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex mr-2 items-center">
                    <!--unlike post-->
                    <unlike-post
                        v-if="feed.liked_by_current_user"
                        :feed="feed"
                    />
                    <!--like post-->
                    <like-post v-else :feed="feed" />
                </div>
                <div class="flex items-center">
                    <div class="flex mr-2">
                        <span class="text-sm"
                            ><span class="font-bold">{{
                                feed.likes.length
                            }}</span>
                            likes</span
                        >
                    </div>
                    {{ "-" }}
                    <div class="ml-2 flex">
                        <ChatIcon class="h-5 w-5 text-blue-400 mr-1" />
                        <span class="text-sm font-bold">{{
                            feed.comments.length
                        }}</span>
                    </div>
                </div>
            </div>
            <div v-if="!disableComments">
                <div class="border-b-2 my-4 border-b-width-1"></div>
                <div>
                    <comments
                        :comments="feed.comments"
                        :post-author-id="feed.author.id"
                    />
                </div>
                <div class="mt-4">
                    <add-comment :post-id="feed.id" />
                </div>
            </div>
        </div>

        <div class="mt-6" v-if="feeds.data.length !== 0">
            <pagination
                :disable-prev="feeds.current_page === 1"
                :disable-next="feeds.last_page === feeds.current_page"
                @next="next"
                @prev="prev"
                @first="first"
                @last="last"
            ></pagination>
        </div>
    </div>
</template>

<script>
import AddComment from "@/Shared/AddComment";
import Comments from "@/Shared/Comments";
import { ChatIcon, HeartIcon, TrashIcon } from "@heroicons/vue/solid";
import Pagination from "@/Shared/Pagination";
import LoadingIcon from "@/Shared/LoadingIcon";
import LikePost from "@/Components/Post/LikePost";
import UnlikePost from "@/Components/Post/UnlikePost";
import DeletePost from "@/Components/Post/DeletePost";
export default {
    name: "Feed",
    props: {
        feeds: Object,
        user: Object,
        disableComments: {
            type: Boolean,
            default: true,
        },
    },
    components: {
        DeletePost,
        UnlikePost,
        LikePost,
        LoadingIcon,
        Pagination,
        Comments,
        AddComment,
        ChatIcon,
        HeartIcon,
        TrashIcon,
    },

    mounted() {},
    data() {
        return {
            page: 1,
        };
    },
    methods: {
        next() {
            this.$inertia.get(
                this.route(this.route().current(), {
                    username: this.user.username,
                }),
                { page: this.feeds.current_page + 1 },
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
                this.route(this.route().current(), {
                    username: this.user.username,
                }),
                { page: this.feeds.current_page - 1 },
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
                this.route(this.route().current(), {
                    username: this.user.username,
                }),
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
                this.route(this.route().current(), {
                    username: this.user.username,
                }),
                { page: this.feeds.last_page },
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
.post-actions button:after {
    content: "-";
}
.post-actions button:last-child:after {
    content: "";
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
