<template>
    <div>
        <div
            v-for="feed in feeds"
            :id="`feed${feed.id}`"
            class="bg-white border rounded-lg mb-4 p-4"
        >
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="mr-2">
                        <img
                            class="h-8 w-8 rounded-full"
                            :src="user.imageUrl"
                            alt=""
                        />
                    </div>
                    <div>
                        <span class="block user-name">{{
                            feed.author.username
                        }}</span>
                        <span class="block text-xs text-gray-700">
                            {{ feed.created_at }}
                        </span>
                    </div>
                </div>
                <div v-if="$page.props.auth.user.id === feed.author.id">
                    <button
                        type="button"
                        @click="openModal(feed.id)"
                        class="text-red-600 hover:text-red-400 flex mt-2"
                    >
                        <TrashIcon class="h-5 w-5 text-red-400" />
                    </button>
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
                <div class="flex mr-2">
                    <button
                        @click="unlike(feed.id)"
                        v-if="feed.liked_by_current_user"
                        :disabled="unlikeForm.processing"
                    >
                        <HeartIcon
                            :class="
                                unlikeForm.processing &&
                                feed.id === selectedPostId &&
                                'animate-bounce'
                            "
                            class="h-5 w-5 text-red-600 mr-1"
                        />
                    </button>
                    <button
                        @click="like(feed.id)"
                        v-else
                        :disabled="likeForm.processing"
                    >
                        <HeartIcon
                            :class="
                                likeForm.processing &&
                                feed.id === selectedPostId &&
                                'animate-bounce'
                            "
                            class="h-5 w-5 text-gray-400 mr-1"
                        />
                    </button>
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
        <confirm-modal
            :open="showModal"
            @confirmed="deletePost"
            text="Are you sure you want to delete this post?"
        />
    </div>
</template>

<script>
import AddComment from "@/Shared/AddComment";
import Comments from "@/Shared/Comments";
const user = {
    name: "Chelsea Hagon",
    email: "chelseahagon@example.com",
    imageUrl:
        "https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};
import { ChatIcon, HeartIcon, TrashIcon } from "@heroicons/vue/solid";
import ConfirmModal from "@/Shared/ConfirmModal";
export default {
    name: "Feed",
    props: {
        feeds: Array,
    },
    components: {
        ConfirmModal,
        Comments,
        AddComment,
        ChatIcon,
        HeartIcon,
        TrashIcon,
    },
    setup() {
        return {
            user,
        };
    },
    mounted() {},
    data() {
        return {
            form: this.$inertia.form({
                post_id: "",
            }),
            likeForm: this.$inertia.form({
                post_id: "",
            }),
            unlikeForm: this.$inertia.form({
                post_id: "",
            }),
            selectedPostId: null,
            showModal: false,
        };
    },

    methods: {
        like(postId) {
            this.selectedPostId = postId;
            this.likeForm.post_id = postId;
            this.likeForm.post(this.route("like.post"), {
                preserveScroll: true,
            });
        },
        unlike(postId) {
            this.selectedPostId = postId;
            this.unlikeForm.post_id = postId;
            this.unlikeForm.post(this.route("unlike.post"), {
                preserveScroll: true,
            });
        },
        openModal(postId) {
            this.showModal = true;
            this.selectedPostId = postId;
        },
        deletePost() {
            this.showModal = false;
            this.form.post_id = this.selectedPostId;
            this.form.delete(this.route("destroy.post"), {
                preserveScroll: true,
            });
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
