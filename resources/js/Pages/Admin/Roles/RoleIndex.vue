<script setup>
import AdminLayoutVue from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps(['roles']);
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayoutVue>
        <div class="py-12">
            <h1>Welcome Role Index Page</h1>
        </div>
    </AdminLayoutVue>
</template>
