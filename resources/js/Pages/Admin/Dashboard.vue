<template>
    <app :page-title="pageTitle">
        <div class="container mx-auto">
            <div class="px-3">
                <stats :stats="stats" />
            </div>
            <div class="px-3 mt-6">
                <div class="p-4 bg-white shadow rounded-lg">
                    <admin-nav :tabs="tabs" />
                </div>
            </div>

            <div class="my-6 rounded-lg p-4">
                <div v-if="route().current() === 'admin'">
                    <admin-users :users="users" />
                </div>
                <div
                    class="bg-white shadow rounded-lg"
                    v-if="route().current() === 'reportedUsers.admin'"
                >
                    reported
                </div>
                <div
                    class="bg-white shadow rounded-lg"
                    v-if="route().current() === 'jobs.admin'"
                >
                    <admin-jobs :jobs="jobs" />
                </div>
            </div>
        </div>
    </app>
</template>

<script>
import App from "@/Layouts/App";
import Stats from "@/Components/Admin/Stats";
import AdminNav from "@/Components/Admin/AdminNav";
import AdminUsers from "@/Components/Admin/AdminUsers";
import AdminJobs from "@/Components/Admin/AdminJobs";
export default {
    name: "Dashboard",
    props: {
        pageTitle: String,
        users: Array,
        jobs: Array,
        messagesCount: Number,
        postsCount: Number,
    },
    watch: {
        users: {
            handler() {
                this.setTabs();
                this.setStats();
            },
            deep: true,
        },
    },
    components: { AdminJobs, AdminUsers, AdminNav, Stats, App },
    data() {
        return {
            tabs: [],
            stats: [],
        };
    },
    mounted() {
        this.setTabs();
        this.setStats();
    },
    methods: {
        setTabs() {
            this.tabs = [
                { name: "Users", href: "admin", count: this.users.length },
                {
                    name: "Jobs & Courses",
                    href: "jobs.admin",
                    count: this.jobs.length,
                },
            ];
        },
        setStats() {
            this.stats = [
                { name: "Total Users", stat: this.users.length },
                { name: "Total Posts", stat: this.postsCount },
                { name: "Total Messages", stat: this.messagesCount },
            ];
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
