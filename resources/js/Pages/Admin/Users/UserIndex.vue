<script setup>
import AdminLayoutVue from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';

defineProps(['users'])
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayoutVue>
        <div class="py-12">
          <Table>
            <template #header>
                <TableRow>
                    <TableHeaderCell>ID</TableHeaderCell>
                    <TableHeaderCell>Name</TableHeaderCell>
                    <TableHeaderCell>Email</TableHeaderCell>
                    <TableHeaderCell>Action</TableHeaderCell>
                </TableRow>
            </template>
            <template #default>
               <TableRow v-for="user in users" :key="user.id" class="border-b">
                   <TableDataCell>{{ user.id }}</TableDataCell>
                   <TableDataCell>{{ user.name }}</TableDataCell>
                   <TableDataCell>{{ user.email }}</TableDataCell>
                   <TableDataCell>Edit/Delete</TableDataCell>
               </TableRow>
            </template>
          </Table>
        </div>
    </AdminLayoutVue>
</template>
