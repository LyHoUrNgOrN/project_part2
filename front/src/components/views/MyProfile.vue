<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg" width="80%">

        <v-container fluid class="container" v-if="show_details">
          <div class="profile me-16">
            <img
              src="https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png"
              alt=""
              width="190"
            />
            <input type="file" id="myFileInput" @change="image" hidden />

            <v-btn
              rounded
              color="cyan white--text"
              width="200"
              onclick="document.getElementById('myFileInput').click()"
              >Change Profile</v-btn
            ><br><br>
          </div>
          
          <v-card-text>
            <div class="txt">
              <span class="sub-txt">First name</span>
              <div><span class="dote">:</span > <span> {{first_name}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Last name</span>
              <div><span class="dote">:</span><span> {{last_name}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <div><span class="dote">:</span><span> {{phone}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <div>
                <span class="dote">:</span><span> {{email}}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Province</span>
              <div><span class="dote">:</span><span> {{province}}</span></div>
            </div>
          </v-card-text>
        </v-container>

        <v-list>
          <v-list-group
            @click="details"
            :value="false"
            rounded
            prepend-icon="mdi-account-circle"
            style="background: #efefef;"
          >
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background: #fff;cursor : default"
              link
            >
              <v-list-item-title
                class="ml-16"
                width="auto"
                v-text="title"
              ></v-list-item-title>

              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon>
                <v-icon color="dark darken-2" style="cursor : pointer"> mdi-pencil </v-icon>
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>
        </v-list>

      </v-card>
    </v-main>
  </div>
</template>


<script>
  export default {
    data() {
      return {
      show_details: true,
      user : [],
      userDetail : '',
      first_name : '',
      last_name : '',
      phone : '',
      email : '',
      isReload : 0,
      province : '',
      cruds: [],
      };
    },
    methods: {
      details() {
        this.show_details = !this.show_details;
      },
      image(e) {
        console.log(e.target.files[0]);
      },
    },
    mounted(){
      // console.log(JSON.parse(localStorage.getItem("userDetail")))
      this.user = JSON.parse(localStorage.getItem('user'));
      this.userDetail = JSON.parse(localStorage.getItem('userDetail'));
      this.first_name = this.user.first_name;
      this.last_name = this.user.last_name;
      this.phone = this.userDetail.phone;
      this.email = this.user.email;
      this.province = this.userDetail.province;
      this.cruds = [
          ["First name", this.first_name],
          ["Last name", this.last_name],
          ["Gender", this.userDetail.gender],
          ["Date of brith", this.userDetail.date_of_birth],
          ["Province", this.province],
          ["Phone", this.phone],
          ["Email", this.user.email],
          ["PNC Batch", this.userDetail.batch],
          ["PNC Major", this.userDetail.major],
          ["Current position", this.userDetail.current_position],
      ];
    },
  };
</script>


<style scoped>
  .container,
  .txt {
    display: flex;
  }
  .sub-txt {
    font-weight: bolder;
    width: 250px;
  }
  .txt span {
    margin: 5px;
  }
  @media (max-width: 960px) {
    .sub-txt {
      width: 100px;
    }
  }
  @media (max-width: 600px) {
    .container,
    .txt,
    .txt div {
      display: block;
    }
    .txt div span {
      margin: 10px;
    }
    .dote {
      display: none;
    }
  }
  button{
    background: rgb(61, 162, 230);
    border-radius: 10px;
    width: 200px;
    height: 35px;
    color: white;
  }

</style>
