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
        <v-toolbar-title class="cyan--text">All users</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search by name type ..."
          single-line
          hide-details
          outlined
          dense
        ></v-text-field>

        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          transition="dialog-top-transition"
          max-width="550px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Create ero user
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" md="6">
                    <v-text-field
                      v-model="first_name"
                      label="First name"
                      :rules="[rules.required]"
                      hide-details="auto"
                      outlined
                      dense
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field
                      outlined
                      dense
                      :rules="[rules.required]"
                      hide-details="auto"
                      v-model="last_name"
                      label="Last name"
                    ></v-text-field>
                  </v-col>




                  <v-col cols="12">
                    <v-text-field
                      hide-details="auto"
                      outlined
                      dense
                      v-model="email"
                      :rules="emailRules"
                      label="E-mail"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      hide-details="auto"
                      outlined
                      dense
                      v-model="password"
                      class="password rounded"
                      :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                      :rules="[rules.required, rules.min, rules.max]"
                      :type="show1 ? 'text' : 'password'"
                      name="input-10-1"
                      label="Password"
                      hint="At least 6 characters"
                      @click:append="show1 = !show1"
                    ></v-text-field>
                  </v-col>
                </v-row>

              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
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
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import axios from "@/api/api.js";
export default {
  data: () => ({
   
    password: "",
    first_name: "",
    last_name: "",

    email: "",

    show1: false,
    search: "",
    dialog: false,
    dialogDelete: false,
    rules: {
      required: (value) => !!value || "Required.",
      min: (v) => v.length >= 6 || "Min 6 characters",
    },
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    headers: [
      {
        align: "start",
        sortable: false,
      },
      { text: "First name", value: "first_name" },
      { text: "Last name", value: "last_name" },
      { text: "User type", value: "role" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      first_name: "",
      last_name: "",
      role: "",
      reset_pwd: "",
    },
    defaultItem: {
      first_name: "",
      last_name: "",
      role: "",
      reset_pwd: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Create ERO user" : "Reset Password";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    
  },

  mounted() {
    this.initialize();
    
  },

  methods: {
    initialize() {
      axios
        .get("http://127.0.0.1:8000/api/user")
        .then((result) => {
          this.desserts = result.data
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
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
      let ero = {
        first_name: this.first_name,
        last_name: this.last_name,
        role: "ERO",
        email: this.email,
        password: this.password,
      };
      axios
        .post("http://127.0.0.1:8000/api/signup", ero)
        .then((result) => {
         console.log(result.data);
         this.initialize()
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
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
