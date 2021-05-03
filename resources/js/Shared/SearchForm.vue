<template>
    <div class="w-full">
        <label for="search" class="sr-only">Search</label>
        <div
            class="relative"
            :style="
                typing
                    ? {
                          zIndex: 10000000,
                      }
                    : {}
            "
        >
            <div
                class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center"
            >
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <input
                id="search"
                name="search"
                class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Search for people"
                type="search"
                @input="setQuery"
                autocomplete="off"
            />
        </div>
        <search-results
            :results="results"
            :searching="searching"
            ref="searchResults"
            @close="close"
            :typing="typing"
        />
    </div>
</template>

<script>
import { SearchIcon } from "@heroicons/vue/solid";
import SearchResults from "@/Shared/SearchResults";

export default {
    name: "SearchForm",
    components: {
        SearchResults,
        SearchIcon,
    },
    data() {
        return {
            typing: false,
            results: [],
            searching: false,
        };
    },
    methods: {
        close() {
            this.typing = false;
        },
        setQuery(e) {
            const q = e.target.value;
            this.typing = !!q;
            this.results = [];
            this.searching = true;
            const that = this;
            setTimeout(function () {
                that.search(q);
            }, 500);
        },
        search(query) {
            axios
                .get(this.route("search", { query: query }))
                .then((response) => {
                    console.log(response.data.results);
                    this.results = response.data.results;
                    const that = this;
                    setTimeout(function () {
                        that.searching = false;
                    }, 200);
                });
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
