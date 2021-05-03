<template>
    <app :page-title="pageTitle">
        <div class="container mx-auto">
            <stats />
            <div class="my-6 bg-white shadow rounded-lg p-4">
                <admin-nav />
            </div>
        </div>
    </app>
</template>

<script>
import App from "@/Layouts/App";
import Stats from "@/Components/Admin/Stats";
import AdminNav from "@/Components/Admin/AdminNav";
export default {
    name: "Dashboard",
    props: {
        pageTitle: String,
    },
    components: { AdminNav, Stats, App },
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
