<template>
<div>
  <h1>Only Admin manage users</h1>
  <Base-search>
  </Base-search>
  <div>
    <v-row justify="space-around">
      <v-col cols="auto">
        <v-dialog transition="dialog-top-transition" max-width="600" v-model="dialog">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              New Item
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
              <v-icon class="" small @click="deleteItem(item)">
                mdi-delete
              </v-icon>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>

</div>

</template>

<script>
import axios from "@/axios-http.js";
export default {
  data() {
 
    return {
       dialog: false,
      todos: [],
      first_name: "",
      last_name: "",
      province: "",

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
     close () {
        this.dialog = false
     },
    save() {
      let eroUser = {
        first_name: this.first_name,
        last_name: this.last_name,
        email: this.email,
        password: this.password,
        role: "ERO",
      };
      console.log(eroUser);
      axios.post("http://127.0.0.1:8000/api/signup",eroUser)
            .then((result) => {
              this.users = result.data
            }).catch((err) => {
              console.log(err.response.data.message);
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
</style>

