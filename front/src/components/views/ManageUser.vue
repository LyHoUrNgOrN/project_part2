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
                    <v-select
                      hide-details="auto"
                      :items="items"
                      label="Role"
                      dense
                      outlined
                      v-model="role"
                    ></v-select>
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

              <v-btn v-if="dialog && !isUpdate" color="blue darken-1" text @click="save"> Save </v-btn>
              <v-btn v-if="isUpdate && dialog" color="blue darken-1" text @click="update"> Update </v-btn>
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
      <v-icon color="gray" left @click="detail(item)">mdi mdi-alert-box</v-icon>
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil {{item}} </v-icon>
      <v-icon color="red" small @click="deleteItem(item)"> mdi-delete </v-icon>
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
    isUpdate : false,
    first_name: "",
    last_name: "",
    email: "",
    role : "",
    items : [
      "ADMIN",
      "ALUMNI",
      "ERO"
    ],
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
      { text: "Profile", value: "profile" },
      { text: "First name", value: "first_name" },
      { text: "Last name", value: "last_name" },
      { text: "Email", value: "email" },
      { text: "User type", value: "role" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    updateId : '',
    editedIndex: -1,
    editedItem: {
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
  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios
        .get("http://127.0.0.1:8000/api/user")
        .then((result) => {
          this.desserts = [];
          result.data.forEach((element) => {
            if (element.role !== "ADMIN") {
              if (element.user_details === null) {
                let user = {
                  profile: null,
                  id : element.id,
                  first_name: element.first_name,
                  last_name: element.last_name,
                  email: element.email,
                  role: element.role,
                  reset_pwd: "",
                };
                this.desserts.push(user);
              } else {
                let user = {
                  id : element.id,
                  profile: element.user_details.picture,
                  first_name: element.first_name,
                  last_name: element.last_name,
                  email: element.email,
                  role: element.role,
                  reset_pwd: "",
                };
                this.desserts.push(user);
              }
            }
          });
        })
        .catch(() => {});
    },
    update() {
      let user = {
        id : this.updateId,
        first_name: this.first_name,
        last_name: this.last_name,
        role: this.role,
        email: this.email,
        password: this.password,
      };
      axios
        .put("http://127.0.0.1:8000/api/updateUser/" + user.id , user)
        .then(() => {
          this.first_name= "";
          this.last_name= "";
          this.role= "";
          this.email = "";
          this.password= "";
          this.initialize();
        })
        .catch(() => {});
      this.close();
    },
    detail(e){
      localStorage.setItem('showUserDetailId',e.id);
      localStorage.setItem('path','/manage-view');
      // localStorage.setItem('userDetailId', e.user_details);
      this.$router.push('/detail-alumni')
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem= this.desserts[this.editedIndex];
      this.first_name= this.editedItem.first_name,
      this.updateId= this.editedItem.id,
      this.last_name= this.editedItem.last_name,
      this.role= this.editedItem.role,
      this.email= this.editedItem.email,
      this.isUpdate = true;
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = this.desserts[this.editedIndex];
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      axios.delete('/signup/' + this.editedItem.id).then(() => {
        this.initialize();
      })
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.isUpdate = false;
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
        .then(() => {
          this.initialize();
        })
        .catch(() => {});

      this.close();
    },
  },
};
</script>
