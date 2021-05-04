<template>
    <app :page-title="$page.props.pageTitle">
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

            <div class="mt-8 px-3 flex flex-wrap-reverse lg:flex-nowrap">
                <div class="mr-0 lg:mr-8 flex-grow">
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
                                <feed :feeds="feeds" :user="user" />
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
                <div class="w-full lg:w-1/3 mb-4 lg:mb-0 flex-none">
                    <div class="bg-white shadow rounded-lg p-4">
                        <profile-about :user="user" />
                    </div>
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
import ProfileAbout from "@/Components/Profile/ProfileAbout";

export default {
    components: {
        ProfileAbout,
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
        feeds: Object,
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
