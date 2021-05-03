<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Last 30 days
        </h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div
                v-for="item in stats"
                :key="item.name"
                class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6"
            >
                <dt class="text-sm font-medium text-gray-500 truncate">
                    {{ item.name }}
                </dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ item.stat }}
                </dd>
            </div>
        </dl>
    </div>
</template>

<script>
const stats = [
    { name: "Total Subscribers", stat: "71,897" },
    { name: "Avg. Open Rate", stat: "58.16%" },
    { name: "Avg. Click Rate", stat: "24.57%" },
];

export default {
    name: "Stats",
    setup() {
        return {
            stats,
        };
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
