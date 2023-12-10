<template>
    <aside
        class="bg-gray-800 text-white h-screen border-gray-700   "
    >
        <div class="">
            <h2 class="text-xl font-semibold mb-4 mt-5  justify-center items-center">Task Manager</h2>
            <ul>
                <li class="sidebar-itemv" active>
                    <span
                        to="/"
                        class="flex items-center justify-center hover:bg-gray-700 rounded-md p-2"
                    >
                        <span class="nav-icon mr-2">📝</span>Tasks
                    </span>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
export default {
    // Vue component logic goes here
};
</script>

<style scoped>
/* Add component-specific styles here */
.sidebar-itemv {
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.sidebar-itemv.active {
    background-color: #8abf3f;
    color: #fff;
}

.nav-icon {
    margin-right: 12px;
    width: 24px;
    height: 24px;
}
</style>
