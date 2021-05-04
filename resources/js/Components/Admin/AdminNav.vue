<template>
    <div>
        <div>
            <nav class="flex space-x-4" aria-label="Tabs">
                <inertia-link
                    v-for="tab in tabs"
                    :key="tab.name"
                    :href="route(tab.href)"
                    :class="[
                        route().current(tab.href)
                            ? 'bg-gray-100 text-gray-700'
                            : 'text-gray-500 hover:text-gray-700',
                        'font-bold px-3 py-2 font-medium text-sm rounded-md',
                    ]"
                    :aria-current="
                        route().current(tab.href) ? 'page' : undefined
                    "
                >
                    {{ tab.name }}
                    <span class="ml-1 font-semibold" v-if="tab.count">{{
                        tab.count
                    }}</span>
                </inertia-link>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminNav",
    props: {
        tabs: Array,
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
