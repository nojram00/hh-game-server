<template>
    <Head title="Edit Section"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Edit Section</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <EditSectionForm
                        :teachers="teachers"
                        :in-production="production_mode"
                        :section="section"
                        class="max-w-lg"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditSectionForm from './Partials/EditSectionForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    section : {
        type : Object,
        required : true
    },
    teachers : {
        type : Object,
        required : true
    },
    production_mode : {
        type : Boolean,
        required : true
    }

})
</script>
<style lang="">

</style>
