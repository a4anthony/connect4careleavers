<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <li
            v-for="person in users"
            :key="person.email"
            class="col-span-1 bg-white rounded-lg shadow divide-gray-200"
        >
            <div class="p-4">
                <div class="w-full flex items-center justify-between space-x-6">
                    <div class="flex-1 truncate">
                        <div class="flex items-center space-x-3">
                            <h3
                                class="text-gray-900 text-sm font-medium truncate"
                            >
                                {{ person.name }}
                            </h3>
                        </div>
                        <inertia-link
                            class="block user-name"
                            :href="
                                route('show.profile', {
                                    username: person.username,
                                })
                            "
                        >
                            {{ person.username }}
                        </inertia-link>
                    </div>
                    <inertia-link
                        class="block user-name"
                        :href="
                            route('show.profile', {
                                username: person.username,
                            })
                        "
                    >
                        <img
                            class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                            :src="person.avatar"
                            alt=""
                    /></inertia-link>
                </div>
                <div class="text-left mt-4">
                    <make-admin :user="person" />
                    <remove-admin :user="person" />
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import MakeAdmin from "@/Components/Admin/MakeAdmin";
import RemoveAdmin from "@/Components/Admin/RemoveAdmin";
export default {
    name: "AdminUsers",
    components: { RemoveAdmin, MakeAdmin },
    props: {
        users: Array,
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
