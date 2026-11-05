<script setup lang="ts">


const name = 'Game Guide Library';
</script>

<template>
    <div
       class="flex size-10 shrink-0 items-center justify-center rounded-md bg-violet-50"
    >
        <img
    src="/images/game-guide-logo.png"
    alt="Game Guide Library"
    class="size-8 object-contain"
/>
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate leading-tight font-semibold">{{
            name
        }}</span>
    </div>
</template>
