<template>
    <div>
        <p v-if="user.bio" class="block text-gray-700 text-sm mb-3">
            <span class="block font-bold mb-2 uppercase text-xs text-gray-800"
                >Bio</span
            >
            {{ user.bio }}
        </p>
        <p v-if="user.website" class="block text-gray-700 text-sm mb-3">
            <span class="block font-bold mb-2 uppercase text-xs text-gray-800"
                >Website</span
            >
            <a
                :href="user.website"
                target="_blank"
                class="text-blue-600 hover:text-blue-500"
                >{{ user.website }}</a
            >
        </p>
        <div
            v-if="user.bio || user.website"
            class="border-b-2 my-2 border-b-width-1"
        ></div>

        <p v-if="user.city" class="block text-gray-700 text-sm mb-2">
            lives in <span class="font-bold">{{ user.city }}</span>
        </p>
        <p v-if="user.country" class="block text-gray-700 text-sm mb-2">
            from <span class="font-bold">{{ user.country }}</span>
        </p>
        <p class="block text-gray-700 text-sm">
            joined on <span class="font-bold">{{ user.created_at }}</span>
        </p>
    </div>
</template>

<script>
export default {
    name: "ProfileAbout",
    props: {
        user: Object,
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
