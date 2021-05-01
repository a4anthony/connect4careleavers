<template>
    <div class="flex items-center space-x-5">
        <div class="flex-shrink-0">
            <div class="relative">
                <img class="h-16 w-16 rounded-full" :src="user.avatar" alt="" />
                <span
                    class="absolute inset-0 shadow-inner rounded-full"
                    aria-hidden="true"
                />
            </div>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ user.name }}
            </h1>
            <p v-if="user.bio" class="text-sm font-medium text-gray-500">
                {{ user.bio }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileHeader",
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
