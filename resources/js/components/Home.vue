<template>
    <div class="flex">
        <!-- Sidebar - col-3 -->
        <div class="w-1/6 p-4 bg-gray-800 text-white">
            <Sidebar />
        </div>

        <!-- Main Content - col-8 -->
        <div class="w-5/6 pl-2 pr-2 ">
            <div
                class="bg-gray-800 h-15 p-5 text-left rounded-bl-md rounded-br-md text-white"
            >
                Task Listing
            </div>

            <!-- Main content goes here -->
            <TasksListing />
        </div>
    </div>
</template>

<script>
import Sidebar from "./sidebar.vue";
import TasksListing from "./TaskList.vue";

export default {
    components: {
        Sidebar,
        TasksListing,
    },
    // Vue component logic goes here
};
</script>

<style scoped>
/* Add component-specific styles here */
</style>
