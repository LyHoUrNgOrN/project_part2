<template>
  <v-data-table
    :headers="headers"
    :items="desserts"
    :search="search"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>My CRUD</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
          outlined
          dense
        ></v-text-field>
        <v-spacer></v-spacer>

        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.profile="{ item }">
      <span class="red--text" v-if="item.profile === null">No image</span>
      <v-img
        v-else
        :src="'http://localhost:8000/storage/profiles/' + item.profile"
        width="65"
        height="65"
        class="rounded-circle ma-1"
      ></v-img>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template></v-data-table
  >
</template>

<script>
import axios from "@/api/api.js";
export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        align: "start",
        sortable: false,
      },
      { text: "Profile", value: "profile" },
      { text: "First name", value: "first_name" },
      { text: "Last name", value: "last_name" },
      { text: "PNC Batch", value: "pnc_batch" },
      { text: "Current position", value: "current_position" },
      { text: "Company", value: "company" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    defaultItem: {
      id: 0,
      profile: "",
      first_name: "",
      last_name: "",
      pnc_batch: 0,
      current_position: "",
      company: "",
    },
  }),

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios
        .get("http://127.0.0.1:8000/api/user")

        .then((result) => {
          result.data.forEach((element) => {
            if (element.role === "ALUMNI") {
              if (element.company == null) {
                let explore = {
                  id: element.id,
                  profile: element.user_details.picture,
                  first_name: element.first_name,
                  last_name: element.last_name,
                  pnc_batch: element.user_details.batch,
                  current_position: "Alumni not yet complete!",
                  company: "Alumni not yet complete!",
                };
                this.desserts.push(explore);
              } else {
                let explore = {
                  id: element.id,
                  profile: element.user_details.picture,
                  first_name: element.first_name,
                  last_name: element.last_name,
                  pnc_batch: element.user_details.batch,
                  current_position: element.company.current_position,
                  company: element.company.company_name,
                };
                this.desserts.push(explore);
              }
            }
          });
        })
        .catch(() => {});
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>

