<template>
  <div>
    <Base-search> </Base-search>
    <div>
      <div class="form-user">
        <h1>Alumni</h1>
        <v-simple-table>
          <template v-slot:default>
            
            <thead>
              <tr class="text-center">
                <th>Profile</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Batch</th>
                <th>Current Position</th>
                <th>Company</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="info in Info" :key="info">
                <td>
                  <img
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                    width="50"
                    class="ma-2"
                  />
                </td>
                <td>{{ info.firstName }}</td>
                <td>{{ info.lastName }}</td>
                <td>{{ info.batch }}</td>
                <td>{{ info.current_position }}</td>
                <td>{{ info.company }}</td>
                <td>
                  <v-icon color="yellow">mdi-grease-pencil</v-icon>
                  <v-icon color="red" @click="deleteItem(user.id)">mdi-delete</v-icon>

                  

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
import axios from "@/api/api.js"
export default {
  data() {
    return {
      Info:[]
    };
  },
  methods: {
    getUser() {

    },
  },
  mounted() {
    axios
      .get("/user")
      .then(result => {
        
        for(let user of result.data){
          axios.get('/user_details/'+ user.id).then(res=> {
            let eachUser = {
              firstName: user.first_name,
              lastName: user.last_name,
              batch: res.data[0].batch,
              current_position: res.data[0].current_position,
              company: "NONE",
            };
            this.Info.push(eachUser);
          });
        }
      })
      .catch((err) => {
        console.log(err.response.data.message);
      });
    },
};
</script>
<style scoped>
.form-user {
  width: 100%;
}
h1{
  margin-left: 3%;
  margin-bottom: 2%;
}
</style>

