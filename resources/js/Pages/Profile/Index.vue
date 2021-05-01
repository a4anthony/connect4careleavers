<template>
    <app>
        <div class="container mx-auto">
            <!-- Page header -->
            <div class="px-3 mx-auto">
                <div
                    class="bg-white shadow rounded-lg p-4 md:flex md:items-center md:justify-between md:space-x-5"
                >
                    <profile-header :user="user" />
                    <profile-actions :user="user" :current-user="currentUser" />
                </div>
            </div>

            <div
                class="mt-8 px-3 max-w-3xl mx-auto grid grid-cols-1 gap-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3"
            >
                <div class="space-y-6 lg:col-start-1 lg:col-span-2">
                    <div class="bg-white shadow rounded-lg p-4">
                        <profile-nav :tabs="tabs" :user="user" />
                    </div>

                    <div class="mt-8">
                        <div
                            v-if="
                                route().current('show.profile', {
                                    username: user.username,
                                })
                            "
                        >
                            <div v-if="currentUser" class="mb-6">
                                <create-post />
                            </div>
                            <div class="border-b-2 my-4 border-b-width-1"></div>
                            <div class="mt-6">
                                <feed :feeds="feeds" />
                            </div>
                        </div>
                        <div
                            v-if="
                                route().current('show.profile.friends', {
                                    username: user.username,
                                })
                            "
                        >
                            <profile-friends
                                :friends="friends"
                                :current-user="currentUser"
                                sort-key="friend"
                            />
                        </div>
                        <div
                            v-if="
                                route().current(
                                    'show.profile.friends.request',
                                    {
                                        username: user.username,
                                    }
                                )
                            "
                        >
                            <profile-friends
                                :friends="friendRequests"
                                :current-user="currentUser"
                                sort-key="user"
                            />
                        </div>
                        <div
                            v-if="
                                route().current('show.profile.about', {
                                    username: user.username,
                                })
                            "
                        >
                            about
                        </div>
                    </div>
                </div>
                <div class="lg:col-start-3 lg:col-span-1">
                    <div class="bg-white shadow rounded-lg p-4">side</div>
                </div>
            </div>
        </div>
    </app>
</template>

<script>
import App from "@/Layouts/App";
import ProfileHeader from "@/Components/Profile/ProfileHeader";
import ProfileActions from "@/Components/Profile/ProfileActions";
import ProfileNav from "@/Components/Profile/ProfileNav";
import Feed from "@/Shared/Feed";
import CreatePost from "@/Shared/CreatePost";
import ProfileFriends from "@/Components/Profile/ProfileFriends";

export default {
    components: {
        ProfileFriends,
        CreatePost,
        Feed,
        ProfileNav,
        ProfileActions,
        ProfileHeader,
        App,
    },
    props: {
        user: Object,
        feeds: Array,
        currentUser: Boolean,
        friends: Array,
        friendRequests: Array,
    },
    data() {
        return {
            tabs: [],
        };
    },
    watch: {
        friends: {
            handler() {
                this.setTabs();
            },
            deep: true,
        },
        friendRequests: {
            handler() {
                this.setTabs();
            },
            deep: true,
        },
    },
    mounted() {
        this.setTabs();
    },
    methods: {
        setTabs() {
            this.tabs = [
                {
                    name: "Posts",
                    href: "show.profile",
                },
                {
                    name: "Friends",
                    href: "show.profile.friends",
                    count: this.friends.length,
                },
            ];

            if (this.currentUser) {
                this.tabs.push({
                    name: "Friend Requests",
                    href: "show.profile.friends.request",
                    count: this.friendRequests.length,
                });
            }
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
