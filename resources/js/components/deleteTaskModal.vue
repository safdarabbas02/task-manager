<template>
  <!-- Delete Task Modal -->
  <div v-if="openModal" class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <!-- Background overlay -->
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <!-- Modal content -->
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <!-- Close button -->
        <button @click="closeModal" class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 cursor-pointer">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>

        <!-- Modal header -->
        <div class="bg-gray-800 px-4 py-3 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-white">Delete Task</h3>
        </div>

        <!-- Modal body -->
        <div class="px-4 py-5 sm:p-6">
          <p class="text-gray-700">
            Are you sure you want to delete this task?
          </p>

          <!-- Modal buttons -->
          <div class="mt-6">
            <!-- Delete button -->
            <button
              @click="deleteTask"
              class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-500 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            >
              Delete
            </button>

            <!-- Cancel button -->
            <button
              @click="closeModal"
              class="inline-flex justify-center px-4 py-2 ml-4 text-sm font-medium text-gray-700 bg-gray-300 border border-transparent rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    openModal: Boolean,
    taskToDelete: Object, // Task to be deleted passed as a prop
  },
  methods: {
    deleteTask() {
      // Implement delete task functionality
      console.log('Delete task:', this.taskToDelete);

      // Emit an event to notify the parent component (tasks.vue) about the task deletion
      this.$emit('taskDeleted', this.taskToDelete.id);

      // Close the modal after emitting the event
      this.closeModal();
    },
    closeModal() {
      // Emit an event to update the openModal prop in the parent component (tasks.vue)
      this.$emit('update:openModal', false);
    },
  },
};
</script>
