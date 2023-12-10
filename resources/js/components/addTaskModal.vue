<template>
  <!-- Modal wrapper -->
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
          <h3 class="text-lg leading-6 font-medium text-white">Add Task</h3>
        </div>

        <!-- Modal body -->
        <div class="px-4 py-5 sm:p-6">
          <!-- Input fields -->
          <div class="mt-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input v-model="taskForm.title" type="text" id="title" name="title" class="mt-1 p-2 border rounded-md w-full" placeholder="Enter title" />
          </div>

          <div class="mt-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea v-model="taskForm.description" id="description" name="description" rows="3" class="mt-1 p-2 border rounded-md w-full" placeholder="Enter description"></textarea>
          </div>

          <div class="mt-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select v-model="taskForm.status" id="status" name="status" class="mt-1 p-2 border rounded-md w-full">
              <option value="completed">Completed</option>
              <option value="pending">Pending</option>
              <!-- Add more status options as needed -->
            </select>
          </div>

          <!-- Modal buttons -->
          <div class="mt-6">
            <button @click="saveTask" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              Save
            </button>
            <button @click="closeModal" class="inline-flex justify-center px-4 py-2 ml-4 text-sm font-medium text-gray-700 bg-gray-300 border border-transparent rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
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
  },
  data() {
    return {
      // Form data for the task
      taskForm: {
        title: '',
        description: '',
        status: 'completed',
      },
    };
  },
  methods: {
    // Method to handle saving a task
    saveTask() {
      // Implement save task functionality
      this.$emit('save-task', this.taskForm);
      // Clear the form data
      this.clearForm();
      // Close the modal after saving
      this.closeModal();
    },
    // Method to close the modal
    closeModal() {
      // Clear the form data
      this.clearForm();
      // Close the modal
      this.$emit("update:openModal", false);
    },
    // Method to clear the form data
    clearForm() {
      // Reset form data
      this.taskForm = {
        title: '',
        description: '',
        status: 'completed',
      };
    },
  },
};
</script>
