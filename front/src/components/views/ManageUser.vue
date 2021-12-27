<template>
  <div>
    <h1>Only Admin manage users</h1>
    <Base-search> </Base-search>
    <div>
      <v-row justify="space-around">
        <v-col cols="auto">
          <v-dialog
            transition="dialog-top-transition"
            max-width="600"
            v-model="dialog"
          >  
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                Create New ERO 
              </v-btn>
            </template>
            <template>
              <v-card>
                <v-toolbar color="primary" dark>Define ERO Account</v-toolbar>
                <div class="pa-6">
                  <v-row>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        label="firstName ..."
                        v-model="first_name"
                        :rules="rules"
                        required
                        hide-details="auto"
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        label="LastName ..."
                        v-model="last_name"
                        :rules="rules"
                        hide-details="auto"
                        outlined
                        required
                        dense
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12">
                      <v-text-field
                        class="rounded-pill"
                        v-model="email"
                        outlined
                        dense
                        :rules="emailRules"
                        hide-details="auto"
                        label="E-mail"
                        required
                      ></v-text-field>
                      <v-text class="red--text">{{ existEmail }}</v-text>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        v-model="password"
                        class="rounded-pill"
                        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                        :rules="[pwd.required, pwd.min]"
                        dense
                        :type="show1 ? 'text' : 'password'"
                        name="input-10-1"
                        hide-details="auto"
                        label="Password"
                        outlined
                        hint="At least 6 characters"
                        @click:append="show1 = !show1"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </div>
                <v-card-actions class="justify-start">
                  <v-btn text @click="save">Save</v-btn>
                  <v-btn text @click="close">Close</v-btn>
                </v-card-actions>
              </v-card>
            </template>
          </v-dialog>
        </v-col>
      </v-row>
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
      <div class="form-user">
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr class="text-center">
              <th>Profile</th>
              <th>First name</th>
              <th>Last name</th>
              <th>Role</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.type">
              <td>
                <!-- <img :src="user.profile" alt="" width="50" class="ma-2" /> -->
                <img
                  src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                  alt=""
                  width="50"
                  class="ma-2"
                />
              </td>
              <td>{{ user.first_name }}</td>
              <td>{{ user.last_name }}</td>
              <td>{{ user.role }}</td>
              <td>
                <v-icon class="" @click="deleteItem(user.id)">
                  mdi-delete
                </v-icon>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "@/axios-http.js";
export default {
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      id: 0,
      first_name: "",
      last_name: "",
      province: "",
      existEmail: "",
      email: "",
      password: "",

      show1: false,
      valid: false,
      rules: [(value) => !!value || "Required."],
      pwd: {
        required: (value) => !!value || "Required.",
        min: (v) => v.length >= 6 || "Min 6 characters",
      },
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
      ],
      picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      users: [],
    };
  },
  methods: {
    deleteItemConfirm() {
      console.log('delete ', this.id);
      axios.delete("http://127.0.0.1:8000/api/signup/"+this.id)
          .then(() => {
          this.getUser()
          this.closeDelete()
          }).catch((err) => {
            console.log(err.response.data.message);
          });

    },

    deleteItem(item) {
      // this.editedIndex = this.desserts.indexOf(item)

      this.dialogDelete = true;
    
      this.id = item
    },
    closeDelete() {
      this.getUser()
      this.dialogDelete = false;
    },
    close() {
      this.getUser()
      this.dialog = false;
    },
    save() {
      let eroUser = {
        first_name: this.first_name,
        last_name: this.last_name,
        role: "ERO",
        email: this.email,
        password: this.password,
      };
      axios
        .post("http://127.0.0.1:8000/api/signup", eroUser)
        .then((result) => {
          this.users = result.data;
          this.close();
          this.getUser();
          this.first_name = ''
          this.email = ''
          this.last_name = ''
          this.password = ''
        })
        .catch((err) => {
          console.log(err.response.data.errors.email[0]);
          if (
            err.response.data.errors.email[0] ===
            "The email has already been taken."
          ) {
            console.log("ok");
            this.existEmail = err.response.data.errors.email[0];
          }
        });
    },
    getUser() {
      axios
        .get("http://127.0.0.1:8000/api/user")
        .then((result) => {
          this.users = result.data;
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
  },
  mounted() {
    this.getUser();
    console.log(this.users);
  },
};
</script>
<style scoped>
  .mb-2{
    margin-left: 283%;
  }
  .form-user{
    width: 1100px;
    margin:auto;
  }
  
</style>

