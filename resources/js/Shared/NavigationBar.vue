<template>
    <!-- When the mobile menu is open, add `overflow-hidden` to the `body` element to prevent double scrollbars -->
    <header class="sticky top-0 bg-indigo-800 shadow-sm lg:overflow-y-visible">
        <div class="container mx-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative flex justify-between xl:grid xl:grid-cols-12 lg:gap-8"
                >
                    <div
                        class="flex md:absolute md:left-0 md:inset-y-0 lg:static xl:col-span-3"
                    >
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link href="/">
                                <logo />
                            </inertia-link>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-5">
                        <div
                            class="invisible sm:visible flex items-center px-6 py-4 md:max-w-3xl md:mx-auto lg:max-w-none lg:mx-0 xl:px-0"
                        >
                            <search-form />
                        </div>
                    </div>
                    <div class="flex items-center justify-end xl:col-span-4">
                        <inertia-link
                            :href="route('all.jobs')"
                            class="ml-5 flex-shrink-0 bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            <BriefcaseIcon
                                class="h-6 w-6 p-1"
                                aria-hidden="true"
                            />
                        </inertia-link>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="flex-shrink-0 relative ml-5">
                            <div>
                                <MenuButton
                                    class="bg-white rounded-full flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    <span class="sr-only">Open user menu</span>
                                    <img
                                        class="h-8 w-8 rounded-full"
                                        :src="$page.props.auth.user.avatar"
                                        alt=""
                                    />
                                </MenuButton>
                            </div>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 focus:outline-none"
                                >
                                    <MenuItem v-slot="{ active }">
                                        <inertia-link
                                            :href="
                                                route('show.profile', {
                                                    username:
                                                        $page.props.auth.user
                                                            .username,
                                                })
                                            "
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            >Your Profile</inertia-link
                                        >
                                    </MenuItem>
                                    <MenuItem
                                        v-if="$page.props.auth.user.is_admin"
                                        v-slot="{ active }"
                                    >
                                        <inertia-link
                                            :href="route('admin')"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            >Admin Panel</inertia-link
                                        >
                                    </MenuItem>

                                    <div
                                        class="relative my-2 w-full border-t border-gray-300"
                                    />

                                    <MenuItem v-slot="{ active }">
                                        <button
                                            href="#"
                                            @click="
                                                $inertia.post(route('logout'))
                                            "
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            class="w-full text-left"
                                        >
                                            Sign out
                                        </button>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverPanel,
} from "@headlessui/vue";
import {
    SearchIcon,
    MailIcon,
    UsersIcon,
    BriefcaseIcon,
} from "@heroicons/vue/solid";
import { BellIcon, MenuIcon, XIcon } from "@heroicons/vue/outline";
import Logo from "@/Shared/Logo";
import Friends from "@/Components/Chat/Friends";
import Button from "@/Components/Button";
import SearchForm from "@/Shared/SearchForm";

export default {
    name: "NavigationBar",
    components: {
        SearchForm,
        Button,
        Friends,
        Logo,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        Popover,
        PopoverButton,
        PopoverPanel,
        BellIcon,
        MenuIcon,
        SearchIcon,
        XIcon,
        MailIcon,
        UsersIcon,
        BriefcaseIcon,
    },
    data() {
        return {
            friendOverlay: true,
            notificationsCount: 0,
            notifications: [],
        };
    },
    created() {},
};
</script>

<style scoped>
header {
    z-index: 1000;
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
