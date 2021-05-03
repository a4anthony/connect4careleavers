<template>
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <select
                id="tabs"
                name="tabs"
                class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
            >
                <option
                    v-for="tab in tabs"
                    :key="tab.name"
                    :selected="tab.current"
                >
                    {{ tab.name }}
                </option>
            </select>
        </div>
        <div class="hidden sm:block">
            <nav class="flex space-x-4" aria-label="Tabs">
                <a
                    v-for="tab in tabs"
                    :key="tab.name"
                    :href="tab.href"
                    :class="[
                        tab.current
                            ? 'bg-gray-100 text-gray-700'
                            : 'text-gray-500 hover:text-gray-700',
                        'font-bold px-3 py-2 font-medium text-sm rounded-md',
                    ]"
                    :aria-current="tab.current ? 'page' : undefined"
                >
                    {{ tab.name }}
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
const tabs = [
    { name: "Users", href: "#", current: false },
    { name: "Reported Users", href: "#", current: false },
    { name: "Jobs & Courses", href: "#", current: true },
];

export default {
    name: "AdminNav",
    setup() {
        return {
            tabs,
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
