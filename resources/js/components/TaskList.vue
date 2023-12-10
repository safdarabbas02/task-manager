<template>
    <div class="container mx-auto mt-8">
      <div class="flex justify-between items-center mb-4">
        <!-- Dropdown for page limit on the left side -->
        <div class="flex items-center space-x-2">
          <span class="text-gray-700">Page Limit:</span>
          <select v-model="pageLimit" @change="changePageLimit" class="border rounded-md p-1">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <!-- Add more options as needed -->
          </select>
        </div>
  
        <!-- Button to add a task on the right side -->
        <button
          @click="openModal = true"
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
        >
          Add Task
        </button>
      </div>
      <table class="min-w-full bg-white border border-gray-300">
        <thead>
          <tr>
            <th @click="sortBy('title')" class="cursor-pointer p-2 border-b border-gray-300">
              Title
            </th>
            <th @click="sortBy('description')" class="cursor-pointer p-2 border-b border-gray-300">
              Description
            </th>
            <th @click="sortBy('status')" class="cursor-pointer p-2 border-b border-gray-300">
              Status
            </th>
            <th class="p-2 border-b border-gray-300">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Display tasks based on pagination -->
          <tr v-for="(task, index) in paginatedTasks" :key="task.id" :class="{ 'bg-gray-100': index % 2 === 0 }">
            <td class="p-2 border-b border-gray-300 text-center">{{ task.title }}</td>
            <td class="p-2 border-b border-gray-300 text-center">{{ task.description }}</td>
            <td class="p-2 border-b border-gray-300 text-center">{{ task.status }}</td>
            <td class="p-2 border-b border-gray-300 text-center">
              <!-- Edit button -->
              <button
                @click="editTask(task)"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
              >
                Edit
              </button>
  
              <!-- Delete button -->
              <button
                @click="deleteTask(task)"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- AddTaskModal for add tasks -->
      <AddTaskModal :openModal.sync="openModal" @save-task="handleSaveTask" />
      <!-- EditTaskModal for editing tasks -->
      <EditTaskModal :openModal.sync="openEditModal" :taskToEdit="taskToEdit" @edit-task="handleEditTask" />
      <!-- DeleteTaskModal for deleting tasks -->
      <DeleteTaskModal
        :openModal.sync="openDeleteModal"
        :taskToDelete="taskToDelete"
        @taskDeleted="handleTaskDeleted"
      />
      <!-- Pagination Controls -->
      <div class="mt-4 flex justify-center">
        <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 mr-2 bg-gray-300">
          Prev
        </button>
        <span class="text-gray-700">Page {{ currentPage }} of {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages" class="px-4 py-2 ml-2 bg-gray-300">
          Next
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import AddTaskModal from "./addTaskModal.vue";
  import EditTaskModal from "./editTaskModal.vue";
  import DeleteTaskModal from "./deleteTaskModal.vue";
  import axios from "axios";

  
  export default {
    // Register new components
    components: {
      AddTaskModal,
      EditTaskModal,
      DeleteTaskModal,
    },
    data() {
      return {
        tasks: [],
        sortByField: null,
        sortDirection: "asc",
        openModal: false,
        openEditModal: false,
        taskToEdit: null,
        openDeleteModal: false,
        taskToDelete: null,
        pageLimit: 10,
        currentPage: 1,
      };
    },
    computed: {
      // Calculate total pages based on the page limit and total tasks
      totalPages() {
        return Math.ceil(this.tasks.length / this.pageLimit);
      },
      // Paginate tasks based on the current page and page limit
      paginatedTasks() {
        const start = (this.currentPage - 1) * this.pageLimit;
        const end = start + this.pageLimit;
        return this.tasks.slice(start, end);
      },
    },
    mounted() {
      this.fetchTasks();
    },
    methods: {
        showToast(type, message) {
          this.$toast[type](message, {
            position: "top-right",
            duration: 3000,
          });
        },
      changePageLimit() {
        // Reset current page to 1 when changing page limit
        this.currentPage = 1;
      },
      async fetchTasks() {
        try {
          const baseUrl = window.location.origin;
          const response = await axios.get(`${baseUrl}/api/tasks`);
          this.tasks = response.data.tasks;
        } catch (error) {
          console.error("Error fetching tasks:", error);
        }
      },
      sortBy(field) {
        if (field === this.sortByField) {
          this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
        } else {
          this.sortByField = field;
          this.sortDirection = "asc";
        }
      },
        async handleSaveTask(taskData) {
        try {
          const baseUrl = window.location.origin;
          await axios.post(`${baseUrl}/api/tasks`, taskData);
          this.fetchTasks();
          this.openModal = false;
         this.showToast("success", "Task added successfully");
        } catch (error) {
          console.error("Error saving task:", error);
          this.showToast("error", error?.response ? error?.response?.data?.message : "Error saving task api");
        }
      },
  
      async handleEditTask(taskData) {
        try {
          const baseUrl = window.location.origin;
          await axios.put(`${baseUrl}/api/tasks/${taskData.id}`, taskData);
          this.fetchTasks();
          this.openModal = false;
          this.showToast("success", "Task updated successfully");
        } catch (error) {
          console.error("Error updating task:", error);
          this.showToast("error", error?.response ? error?.response?.data?.message : "Error updating task api");
        }
      },
  
      async handleTaskDeleted(taskId) {
        try {
          const baseUrl = window.location.origin;
          console.log("Task deleted with ID:", taskId);
          await axios.delete(`${baseUrl}/api/tasks/${taskId}`);
          this.fetchTasks();
          this.showToast("success", "Task deleted successfully");
        } catch (error) {
          console.error("Error deleting task:", error);
          this.showToast("error", error?.response ? error?.response?.data?.message : "Error deleting task");
        }
      },
      async editTask(task) {
        try {
        const baseUrl = window.location.origin;
        const response = await axios.get(`${baseUrl}/api/tasks/${task.id}`);
        // Set the task to edit and open the edit modal
        this.taskToEdit = response.data.task;
        this.openEditModal = true;
    } catch (error) {
          console.error("Error edit task:", error);
          this.showToast("error", error?.response ? error?.response?.data?.message : "Error edit task");
        }
      },
      deleteTask(task) {
        // Set the task to delete and open the delete modal
        this.taskToDelete = task;
        this.openDeleteModal = true;
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
    },
  };
  </script>
  
  <style scoped>
.toasted {
  font-size: 14px;
}

.toast {
  border-radius: 4px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

.toast-success {
  background-color: #4caf50;
  color: #fff;
}

.toast-error {
  background-color: #f44336;
  color: #fff;
}
</style>
  