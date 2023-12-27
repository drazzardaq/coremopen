<script setup>
import { ref, watch, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import DialogModal from "@/Components/DialogModal.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { initTooltips, initPopovers } from "flowbite";
import { useToast } from "vue-toastification";
import axios from "axios";

const props = defineProps({
  items: Object,
  filters: Object,
  statuses: Array,
  priorities: Array,
});

const toast = useToast();

onMounted(() => {
  flowbiteInit();
});

const flowbiteInit = () => {
  setTimeout(() => {
    initTooltips();
    initPopovers();
  }, 500);
};

const activeRow = ref({
  id: 0,
  category_id: 4,
  priority_id: 1,
  status_id: 1,
  title: "",
  description: "",
  date: "",
  tag: "",
  archived: 0,
});

const modal = ref({
  active: false,
  title: "",
  text: "",
  button: "",
});

const request = ref("");

const errors = ref({
  title: "",
});

const actions = (row, action, status) => {
  switch (action) {
    case "create":
      modal.value.title = "Add Item";
      modal.value.button = "Create";
      request.value = "item.store";
      break;
    case "read":
      modal.value.title = "Read Item";
      modal.value.button = "Read";
      break;
    case "delete":
      modal.value.title = "Delete Item";
      modal.value.text = "Are you sure you want to delete this item? Perhaps archive instead?";
      modal.value.button = "Delete";
      request.value = "item.destroy";
      break;
    case "update":
      modal.value.title = "Edit Item";
      modal.value.button = "Update";
      request.value = "item.update";
      break;
    case "status":
      request.value = "item.status";
      break;
    case "archive":
      modal.value.button = "Archive";
      request.value = "item.archive";
      break;
  }

  if (row != -1) activeRow.value = props.items.data.filter((i) => i.id == row)[0];
  if (status) activeRow.value.status_id = status;

  if (action != "status" && action != "archive") modal.value.active = true;
  else call();
};

const call = () => {
  event.preventDefault();
  let formData = new FormData();

  Object.entries(activeRow.value).forEach(([key, value]) => {
    formData.append(key, value);
  });

  axios({ method: "post", url: route(request.value), data: formData, headers: { "Content-Type": "multipart/form-data" } })
    .then((response) => {
      toast.success(response.data, { position: "top-center" });
      closeModal();
    })
    .catch((err) => {
      errors.value.title = err.response.data.message;
    });
};

const archive = ref(props.filters.includeArchive);

const archived = () => {
  archive.value = !archive.value;
};

const sorting = ref({
  field: props.filters.sortBy,
  direction: props.filters.direction,
});

const search = ref(props.filters.search);

const sort = (field, direction) => {
  sorting.value.field = field;
  sorting.value.direction = direction;
};

watch(
  () => [search.value, sorting.value, archive.value],
  ([search, sorting, includeArchive]) => {
    flowbiteInit();
    router.get(route("tasks.index"), { search: search, sortBy: sorting.field, direction: sorting.direction, includeArchive: includeArchive }, { preserveState: true, replace: true });
  },
  { deep: true }
);

const closeModal = () => {
  modal.value = {
    active: false,
    title: "",
    text: "",
    button: "",
  };

  errors.value = {
    title: "",
  };

  activeRow.value = {
    id: 0,
    category_id: 4,
    priority_id: 1,
    status_id: 1,
    title: "",
    description: "",
    date: "",
    tag: "",
    archived: 0,
  };

  flowbiteInit();
  router.reload();
};

const exportCSV = () => {
  axios.post(route("item.export")).then((response) => {
    let blob = new Blob([response.data], { type: "text/csv;charset=utf-8;" });
    let url = URL.createObjectURL(blob);
    let pom = document.createElement("a");
    pom.href = url;
    pom.setAttribute("download", "Corem-Items.csv");
    pom.click();
  });
};
</script>

<template>
  <AppLayout title="Tasks">
    <template #header>
      <div class="flex flex-row-reverse items-center justify-between w-full flex-wrap">
        <PrimaryButton @click="actions(-1, 'create')">
          <FontAwesomeIcon icon="plus" class="mr-2" />
          <span>Add Item</span>
        </PrimaryButton>
        <label class="relative inline-flex flex-row items-center cursor-pointer mr-3">
          <input type="checkbox" class="sr-only peer" v-model="archive" @click="archived()" />
          <div class="w-11 h-6 bg-gray-300 peer- peer-focus:ring-0 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-accent peer-checked:after:border-4 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-transparent after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
          <label class="ml-2 text-primary uppercase text-xs font-medium">Include Archive</label>
        </label>
        <span class="sm:mr-auto mt-2 sm:mt-0 flex w-full sm:w-max">
          <TextInput id="search" type="text" class="mr-2" placeholder="Search" v-model="search" />
          <PrimaryButton class="ml-auto sm:ml-0 self-end" @click="exportCSV">
            <FontAwesomeIcon icon="download" class="mr-2" />
            <span>Export</span>
          </PrimaryButton>
        </span>
      </div>
    </template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12 overflow-x-hidden">
      <div class="h-[240px] min-h-[240px]">
        <table v-if="$props.items.data.length > 0" class="table-fixed shadow-xl shadow-black/5 border-separate border-spacing-0 text-sm rounded-b-lg">
          <thead>
            <tr>
              <th class="w-[34%] min-w-[34%]">
                <div class="flex p-0 m-0">
                  <span>Title</span>
                  <div class="ml-auto inline-flex flex-col text-sm h-[18px] max-h-[18px] justify-around" data-tooltip-target="tooltip-sorting-status" data-tooltip-placement="left">
                    <FontAwesomeIcon icon="sort-up" class="mt-2 -mb-1 cursor-pointer" @click="sort('status_id', 'asc')" :class="sorting.field === 'status_id' && sorting.direction === 'asc' ? 'text-accent saturate-150' : 'text-primary/20'" />
                    <FontAwesomeIcon icon="sort-down" class="mb-2 -mt-1 cursor-pointer" @click="sort('status_id', 'desc')" :class="sorting.field === 'status_id' && sorting.direction === 'desc' ? 'text-accent saturate-150' : 'text-primary/20'" />
                  </div>
                  <div id="tooltip-sorting-status" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity bg-gray-200 rounded-lg shadow opacity-0 tooltip dark:bg-gray-700">
                    <span>Sort by Status</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </div>
              </th>
              <th class="hidden md:table-cell">
                <div class="flex p-0 m-0">
                  <span>Due Date</span>
                  <div class="ml-auto inline-flex flex-col text-sm w-min h-[18px] max-h-[18px] justify-around" data-tooltip-target="tooltip-sorting-date" data-tooltip-placement="left">
                    <FontAwesomeIcon icon="sort-up" class="mt-2 -mb-1 cursor-pointer" @click="sort('date', 'asc')" :class="sorting.field === 'date' && sorting.direction === 'asc' ? 'text-accent saturate-150' : 'text-primary/20'" />
                    <FontAwesomeIcon icon="sort-down" class="mb-2 -mt-1 cursor-pointer" @click="sort('date', 'desc')" :class="sorting.field === 'date' && sorting.direction === 'desc' ? 'text-accent saturate-150' : 'text-primary/20'" />
                  </div>
                  <div id="tooltip-sorting-date" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity bg-gray-200 rounded-lg shadow opacity-0 tooltip dark:bg-gray-700">
                    <span>Sort by Date</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </div>
              </th>
              <th>
                <div class="flex p-0 m-0">
                  <span>Priority</span>
                  <div class="ml-auto inline-flex flex-col text-sm w-min h-[18px] max-h-[18px] justify-around" data-tooltip-target="tooltip-sorting-priority" data-tooltip-placement="left">
                    <FontAwesomeIcon icon="sort-up" class="mt-2 -mb-1 cursor-pointer" @click="sort('priority_id', 'asc')" :class="sorting.field === 'priority_id' && sorting.direction === 'asc' ? 'text-accent saturate-150' : 'text-primary/20'" />
                    <FontAwesomeIcon icon="sort-down" class="mb-2 -mt-1 cursor-pointer" @click="sort('priority_id', 'desc')" :class="sorting.field === 'priority_id' && sorting.direction === 'desc' ? 'text-accent saturate-150' : 'text-primary/20'" />
                  </div>
                  <div id="tooltip-sorting-priority" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity bg-gray-200 rounded-lg shadow opacity-0 tooltip dark:bg-gray-700">
                    <span>Sort by Priority</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </div>
              </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="item in $props.items.data" :key="item.id">
              <tr>
                <td class="w-[34%] min-w-[34%]">
                  <FontAwesomeIcon :icon="item.status.icon" class="text-sm md:text-base lg:text-lg -ml-1 md:-ml-px mr-1 md:mr-2 md:-mb-[2px]" :class="item.status.color" :data-popover-target="'popover-status-' + item.id" data-popover-placement="right" />
                  <div data-popover :id="'popover-status-' + item.id" role="tooltip" class="absolute z-10 invisible inline-block w-max text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                      <h3 class="font-medium text-gray-900 dark:text-shade uppercase text-xs">Status</h3>
                    </div>
                    <div class="px-3 py-2 flex items-center">
                      <template v-for="s in statuses" :key="s.id">
                        <FontAwesomeIcon v-if="s.id != item.status_id" :icon="s.icon" class="mr-2 hover:saturate-150 cursor-pointer text-sm md:text-base lg:text-lg" :class="s.color" @click="actions(item.id, 'status', s.id)" />
                      </template>
                    </div>
                    <div data-popper-arrow></div>
                  </div>
                  <span class="hidden md:inline">{{ item.title }}</span>
                  <span class="inline md:hidden">{{ item.title.length < 8 ? item.title : item.title.substring(0, 7) + "..." }}</span>
                </td>
                <td class="hidden md:table-cell">{{ item.date ? item.date : "N/A" }}</td>
                <td>
                  <div :class="item.priority.color">{{ item.priority.name }}</div>
                </td>
                <td>
                  <FontAwesomeIcon icon="eye" class="text-primary/60 text-sm md:text-base lg:text-lg mr-2 focus:ring-0 focus:text-accent hover:text-accent transition cursor-pointer" :data-tooltip-target="'tooltip-details' + item.id" @click="actions(item.id, 'read')" />
                  <div :id="'tooltip-details' + item.id" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity shadow bg-gray-200 rounded-lg opacity-0 tooltip dark:bg-gray-700">
                    <span>Details</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                  <FontAwesomeIcon icon="edit" class="text-primary/60 text-sm md:text-base lg:text-lg mr-2 focus:ring-0 focus:text-accent hover:text-accent transition cursor-pointer" :data-tooltip-target="'tooltip-update' + item.id" @click="actions(item.id, 'update')" />
                  <div :id="'tooltip-update' + item.id" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity shadow bg-gray-200 rounded-lg opacity-0 tooltip dark:bg-gray-700">
                    <span>Edit</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                  <FontAwesomeIcon :icon="item.archived ? 'folder-minus' : 'folder-plus'" class="text-primary/60 text-sm md:text-base lg:text-lg mr-2 focus:ring-0 focus:text-accent hover:text-accent transition cursor-pointer" :data-tooltip-target="'tooltip-archive' + item.id" @click="actions(item.id, 'archive')" />
                  <div :id="'tooltip-archive' + item.id" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity shadow bg-gray-200 rounded-lg opacity-0 tooltip dark:bg-gray-700">
                    <span>{{ item.archived ? "Unarchive" : "Archive" }}</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                  <FontAwesomeIcon icon="trash" class="text-primary/60 text-sm md:text-base lg:text-lg focus:ring-0 focus:text-accent hover:text-accent transition cursor-pointer" :data-tooltip-target="'tooltip-trash' + item.id" @click="actions(item.id, 'delete')" />
                  <div :id="'tooltip-trash' + item.id" role="tooltip" class="uppercase absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-primary transition-opacity shadow bg-gray-200 rounded-lg opacity-0 tooltip dark:bg-gray-700">
                    <span>Delete</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
        <template v-else>
          <p class="text-center mb-10">No items found.</p>
          <div class="mx-auto w-full text-center flex items-center justify-center text-sm font-medium">
            <span class="text-success mr-1">Hint:</span>
            <span>Hit</span>
            <PrimaryButton @click="actions(-1, 'create')" class="inline-flex mx-2">
              <FontAwesomeIcon icon="plus" class="mr-2" />
              <span>Add Item</span>
            </PrimaryButton>
            <span>button to start.</span>
          </div>
          <template v-if="search != ''">
            <div class="h-px bg-primary/5 my-8 w-[300px] mx-auto flex items-start justify-center">
              <p class="px-3 mb-0 -mt-3 bg-[#fff9f9]">or</p>
            </div>
            <div class="mx-auto w-full text-center flex-col flex items-center justify-center text-sm">
              <p class="font-medium">Refine or clear the following input:</p>
              <TextInput id="search" type="text" class="font-normal" placeholder="Search" v-model="search" />
            </div>
          </template>
        </template>
      </div>
      <Pagination v-if="$props.items.total > 5" :links="$props.items.links" />
    </div>
    <DialogModal :show="modal.active" @close="closeModal">
      <template #title>
        <span>{{ modal.title }}</span>
      </template>

      <form>
        <div class="my-4 text-sm text-gray-600 px-6 py-4">
					<span>{{ modal.text }}</span>
          <input v-model="activeRow.id" type="number" hidden disabled />

          <template v-if="modal.button != 'Delete'">
            <div class="grid grid-cols-2 gap-6 w-full">
              <div class="flex flex-col">
                <InputLabel for="title" value="Title" :dark="true" />
                <TextInput id="title" v-model="activeRow.title" type="text" :disabled="modal.button === 'Read'" />
                <InputError :message="errors.title" class="mt-2" />
              </div>

              <div class="flex flex-col">
                <InputLabel for="category_id" value="Category" :dark="true" />
                <select id="category_id" v-model="activeRow.category_id" :disabled="modal.button === 'Read'" class="border-gray-300 focus:border-blue-500 focus:ring-0 rounded-lg shadow focus:shadow-sm duration-500">
                  <option :value="1" disabled>Life</option>
                  <option :value="2" disabled>Businesses</option>
                  <option :value="3">Projects</option>
                  <option :value="4">Tasks</option>
                  <option :value="5">Finances</option>
                  <option :value="6">Identity</option>
                </select>
              </div>
            </div>

            <div class="mt-4 w-full">
              <InputLabel for="description" value="Description" :dark="true" />
              <textarea id="description" v-model="activeRow.description" :disabled="modal.button === 'Read'" class="w-full border-gray-300 focus:border-blue-500 focus:ring-0 rounded-lg shadow focus:shadow-sm duration-500" />
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4 w-full">
              <div class="flex flex-col">
                <InputLabel for="priority_id" value="Priority" :dark="true" />
                <select id="priority_id" v-model="activeRow.priority_id" :disabled="modal.button === 'Read'" class="border-gray-300 focus:border-blue-500 focus:ring-0 rounded-lg shadow focus:shadow-sm duration-500">
                  <option v-for="p in priorities" :value="p.id">{{ p.name }}</option>
                </select>
              </div>

              <div class="flex flex-col">
                <InputLabel for="status_id" value="Status" :dark="true" />
                <select id="status_id" v-model="activeRow.status_id" :disabled="modal.button === 'Read'" class="border-gray-300 focus:border-blue-500 focus:ring-0 rounded-lg shadow focus:shadow-sm duration-500">
                  <option v-for="s in statuses" :value="s.id">{{ s.name }}</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-6 w-full mt-4">
              <div class="flex flex-col">
                <InputLabel for="date" value="Due Date" :dark="true" />
                <input id="date" type="date" v-model="activeRow.date" :disabled="modal.button === 'Read'" class="border-gray-300 focus:border-blue-500 focus:ring-0 rounded-lg shadow focus:shadow-sm duration-500" />
              </div>

              <div class="flex flex-col">
                <InputLabel for="tag" value="Tag" :dark="true" />
                <TextInput id="tag" v-model="activeRow.tag" :disabled="modal.button === 'Read'" type="text" />
              </div>
            </div>
          </template>
        </div>
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right h-max max-h-max rounded-b-lg">
          <DangerButton type="button" @click="closeModal">Close</DangerButton>
          <PrimaryButton type="button" v-if="modal.button != ('' || 'Read')" class="ml-3" @click="call">{{ modal.button }}</PrimaryButton>
        </div>
      </form>
    </DialogModal>
  </AppLayout>
</template>
