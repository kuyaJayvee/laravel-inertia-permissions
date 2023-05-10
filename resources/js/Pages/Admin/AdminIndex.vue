<script setup>
import AdminLayoutVue from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayoutVue>
      <div class="py-12">
        <div class="max-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome admin 
                </div>
            </div>
        </div>
      </div>
    </AdminLayoutVue>
</template>
