<template>
    <div class="flex items-center">
        <div class="mr-2">
            <inertia-link
                :href="
                    route('show.profile', {
                        username: friend.username,
                    })
                "
            >
                <img class="h-8 w-8 rounded-full" :src="friend.avatar" alt="" />
            </inertia-link>
        </div>
        <div>
            <h3 class="text-gray-900 text-sm font-medium truncate">
                {{ friend.name }}
            </h3>
            <inertia-link
                class="block user-name"
                :href="
                    route('show.profile', {
                        username: friend.username,
                    })
                "
            >
                {{ friend.username }}
            </inertia-link>
            <!--<span class="block text-xs text-gray-700">-->
            <!--    {{ feed.created_at }}-->
            <!--</span>-->
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatHeader",
    props: {
        friend: Object,
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
