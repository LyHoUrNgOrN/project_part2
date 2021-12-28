<template>
  <div>
    <h1>Only Admin manage users</h1>
    <Base-search> </Base-search>
    <div>
      <v-row justify="space-around">
        <v-col cols="auto">
          <v-dialog transition="dialog-top-transition" max-width="600">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                New Item
              </v-btn>
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
                <img :src="user.profile" alt="" width="50" class="ma-2" />
              </td>
              <td>{{ user.first_name }}</td>
              <td>{{ user.last_name }}</td>
              <td>{{ user.type }}</td>
              <td>
                <v-icon class="" small @click="deleteItem(item)" color="red">
                  mdi-delete
                </v-icon>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </div>

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
              <img :src="user.profile" alt="" width="50" class="ma-2" />
            </td>
            <td>{{ user.first_name }}</td>
            <td>{{ user.last_name }}</td>
            <td>{{ user.type }}</td>
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
</template>


<script>
export default {
  data() {
    return {
      picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      users: [
        {
          profile:
            "https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png",
          first_name: "Sara",
          last_name: "Hun",
          type: "admin",
        },
        {
          profile:
            "https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png",
          first_name: "Sara",
          last_name: "Hun",
          type: "admin",
        },
        {
          profile:
            "https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png",
          first_name: "Sara",
          last_name: "Hun",
          type: "admin",
        },
      ],
    };
  },
};
</script>


<style scoped>
.mb-2 {
  margin-top: 20px;
  margin-bottom: 30px;
  margin-left: 92%;
}
</style>

