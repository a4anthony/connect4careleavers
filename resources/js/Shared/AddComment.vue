<template>
    <div>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="mr-2">
                    <inertia-link
                        :href="
                            route('show.profile', {
                                username: $page.props.auth.user.username,
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
                <div class="flex-grow">
                    <div>
                        <label :for="id" class="hidden"></label>
                        <div class="relative">
                            <textarea
                                :id="id"
                                name="body"
                                rows="1"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="What's happening?"
                                v-model="form.body"
                                maxlength="250"
                                required
                            ></textarea>
                            <span
                                class="text-xs block mt-2 absolute -bottom-5 left-0"
                                >{{ 150 - form.body.length }}</span
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-3">
                <button
                    :class="{ 'opacity-25': form.body.length === 0 }"
                    :disabled="form.processing || form.body.length === 0"
                    type="submit"
                    class="font-bold inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <span v-if="!form.processing"> Add Comment </span>
                    <loading-icon v-else />
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import { TrashIcon } from "@heroicons/vue/solid/esm";
import LoadingIcon from "@/Shared/LoadingIcon";
const uniqueId = require("lodash.uniqueid");

const user = {
    name: "Chelsea Hagon",
    email: "chelseahagon@example.com",
    imageUrl:
        "https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};
export default {
    name: "AddComment",
    components: {
        LoadingIcon,
        TrashIcon,
    },
    setup() {
        return {
            user,
        };
    },
    data() {
        return {
            form: this.$inertia.form({
                body: "",
                post_id: null,
            }),
        };
    },
    props: {
        postId: Number,
        id: {
            type: String,
            default() {
                return `text-input-${uniqueId()}`;
            },
        },
    },
    methods: {
        submit() {
            this.form.post_id = this.postId;
            this.form.post(this.route("store.comment"), {
                preserveScroll: true,
                onFinish: () => {
                    this.form.reset("processing");
                    if (Object.keys(this.form.errors).length === 0) {
                        this.form.reset("body");
                    }
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
