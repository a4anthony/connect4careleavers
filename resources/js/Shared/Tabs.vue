<template>
    <div>
        <div>
            <nav
                class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200"
                aria-label="Tabs"
            >
                <inertia-link
                    preserve-scroll
                    v-for="(tab, tabIdx) in tabs"
                    :key="tab.name"
                    :href="route(tab.href)"
                    :class="[
                        route().current(tab.href)
                            ? 'text-gray-900'
                            : 'text-gray-500 hover:text-gray-700',
                        tabIdx === 0 ? 'rounded-l-lg' : '',
                        tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '',
                        'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10',
                    ]"
                    :aria-current="route(tab.href) ? 'page' : undefined"
                >
                    <span class="font-bold">{{ tab.name }}</span>
                    <span
                        aria-hidden="true"
                        :class="[
                            route().current(tab.href)
                                ? 'bg-indigo-500'
                                : 'bg-transparent',
                            'absolute inset-x-0 bottom-0 h-0.5',
                        ]"
                    />
                </inertia-link>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "Tabs",
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
