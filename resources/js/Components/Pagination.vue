<template>
    <div :class="`join ${className}`">
        <Link :href="firstPageUrl" class="join-item btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
            </svg>
        </Link>
        <Link :href="prevPageUrl" class="join-item btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </Link>
        <p class="join-item btn bg-accent text-white">{{ currentPage }}</p>
        <Link :href="nextPageUrl" class="join-item btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </Link>
        <Link :href="lastPageUrl" class="join-item btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
            </svg>
        </Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
    defineProps({
        lastPageUrl : {
            type: String
        },
        firstPageUrl : {
            type: String
        },
        prevPageUrl : {
            type: String
        },
        nextPageUrl : {
            type: String
        },
        currentPage : {
            type: String
        },
        className : {
            type : String
        }
    })
</script>
