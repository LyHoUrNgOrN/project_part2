<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg mt-5" width="80%">
        <v-container fluid class="container mx-auto ml-10">
          <div class="profile me-16">
            <v-img
              :src="'http://localhost:8000/storage/profiles/' + name_img"
              alt=""
              width="190"
              height="190"
              style="border: 0.5px solid black"
              class="rounded-circle"
            ></v-img>
            <input type="file" id="myFileInput" @change="changeFile" hidden />

            <v-row justify="center">
              <v-dialog v-model="dialog" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="#44C7F5"
                    dark
                    v-bind="attrs"
                    class="mt-6 rounded-pill"
                    v-on="on"
                  >
                    Change Profile
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title ripple>
                    <span
                      class="text-h6 ma-auto font-weight-black"
                      color="#44C7F5"
                      >Update profile photo
                    </span>
                    <v-icon large @click="dialog = false"
                      >mdi-close-circle-outline</v-icon
                    >
                  </v-card-title>
                  <v-divider width="100%" />
                  <v-container>
                    <img
                      class="ma-auto pa-5"
                      :src="imageToDisplay"
                      alt=""
                      width="200"
                    />
                  </v-container>
                  <v-divider width="100%" />
                  <v-card-actions class="pa-4">
                    <v-btn
                      class=" rounded-pill white--text"
                      color="#44C7F5"
                      onclick="document.getElementById('myFileInput').click()"
                      ><v-icon>mdi-plus</v-icon>Upload Photo
                    </v-btn>
                    <!-- <v-spacer></v-spacer> -->
                    <!-- <v-btn class="rounded-pill" color="#44C7F5" @click="dialog = false">
                      Cancel
                    </v-btn> -->
                    <v-btn class="rounded-pill white--text" color="#44C7F5" @click="updateProfile"> Save </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-row>
          </div>
          <v-card-text>
            <div class="txt mx-auto">
              <span class="sub-txt">First name</span>
              <div>
                <span class="dote">:</span> <span> {{ first_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Last name</span>
              <div>
                <span class="dote">:</span><span> {{ last_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <div>
                <span class="dote">:</span><span> {{ phone }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <div>
                <span class="dote">:</span><span> {{ email }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Province</span>
              <div>
                <span class="dote">:</span><span> {{ province }}</span>
              </div>
            </div>
          </v-card-text>
        </v-container>

        <v-list-item-icon class="d-flex justify-end mr-10">
          <v-btn @click="showDialog = true" color="green lighten-1 white--text rounded-pill"
            >Edit your information</v-btn
          >
        </v-list-item-icon>

        <v-list>
          <v-list-group
            :value="false"
            rounded
            prepend-icon="mdi-account-circle"
            style="background: #efefef"
          >
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background: #fff; cursor: default"
              link
            >
              <v-list-item-title
                class="ml-16"
                width="auto"
                v-text="title"
              ></v-list-item-title>
              <v-list-item-title v-text="name"></v-list-item-title>
            </v-list-item>
          </v-list-group>
        </v-list>
        <Dialog v-if="showDialog" @cancel="cancel" />
      </v-card>
      
      <v-card  class="mx-auto pa-5 mt-8" width="80%">
          <div class="d-flex justify-space-between">
            <v-card-title class="text-h4 cyan--text ml-10"
            >Skill</v-card-title>
            <v-dialog v-model="dialogSkill" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn 
                    class="mr-5"
                    v-bind="attrs"
                    small
                    fab
                    color="#44C7F5"
                    v-on="on"
                  >
                    <v-icon color="#ffffff">
                      mdi-plus
                    </v-icon>
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title ripple>
                    <span
                      class="text-h6 ma-auto font-weight-black"
                      color="#44C7F5"
                      >Add New Skill
                    </span>
                    <v-icon large @click="cancel(false)"
                      >mdi-close-circle-outline</v-icon
                    >
                  </v-card-title>
                  <v-divider width="100%" />
                  <v-text-field
                    hide-details="auto"
                    outlined
                    dense
                    label="Skill Name..."
                    class="mt-2 rounded-pill pa-10" 
                    v-model="newSkillName"
                   
                  ></v-text-field>
                  <v-divider width="100%" />
                  <v-card-actions class="pa-2 justify-end">
                    <v-btn v-if="openBtn == 'update'" class="rounded-pill white--text mt-2 mr-4" color="#44C7F5" @click="confirmUpdate">Update</v-btn>
                    <v-btn v-else class="rounded-pill white--text mt-2 mr-4" color="#44C7F5" @click="creatNewSkill"> Save </v-btn>
                  </v-card-actions>
                </v-card>
            </v-dialog>
          </div> 
           
        <div class="ml-12">
           <v-chip
              v-for="(skill, index) in skills" :key="index" 
              color="#000000"
              class="ma-2 mt-3 pa-4"
              outlined
            >{{ skill.skill_name }} 
              <v-icon class="iconSkillEdit ml-2" @click="updateSkill(skill)">mdi-border-color</v-icon> 
              <v-icon class="iconSkillDelete ml-1" @click="deleteSkill(skill)">mdi-close-circle</v-icon> 
            </v-chip>
        </div>
      </v-card>

    </v-main>
      
    
  </div>
</template>

<script>
import axios from "@/api/api.js";
import Dialog from "./dialogEdit.vue";
export default {
  components: {
    Dialog,
  },
  data() {
    return {
      skill_id: 0,
      skill_name: "",
      skillEdit : "",
      openBtn : '',
      skills: [],
       newSkillName: "",
      showDialog: false,
      dialog: false,
      dialogSkill: false,
      user: [],
      userDetail: "",
      first_name: "",
      last_name: "",
      phone: "",
      email: "",
      isReload: 0,
      province: "",
      cruds: [],
      name_img: "",
      imageToDisplay:
        "https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png",
      
      imageFile: null,
      show_img: true,
      editProfileID: 0,
      btn_save: true,
      user_id: 0,
      id: 0,
     
     
    };
  },
  methods: {
    getAllSkill(){
      this.dialogSkill = false;
      this.user = JSON.parse(localStorage.getItem("user"));
      axios.get("/skills/" + this.user.id).then((res) => {
        this.skills = res.data;
        
      })
    },
    saveSkill(){
      this.openBtn = "create";
      this.dialogSkill = true;
      this.creatNewSkill();
    },

    creatNewSkill(){
      let newSkill = {
        user_id: JSON.parse(localStorage.getItem("user")).id,
        skill_name: this.newSkillName
      }
      axios.post('/skills/', newSkill).then(res => {
        this.skill = res.data;
        this.getAllSkill();
      });
      this.dialogSkill = false;
      this.newSkillName = '';
    },
    deleteSkill(skill){
      axios.delete('/skills/'+skill.id).then(()=>{
        this.newSkillName = '';
        this.getAllSkill();
      })
    },
    updateSkill(skill){
      this.openBtn = "update";
      axios.get('/skills/'+skill.user_id).then(res=>{
        for(let getSkill of res.data){
          if(skill.id === getSkill.id){
            this.dialogSkill = true;
            this.skillEdit = getSkill;
            this.newSkillName = this.skillEdit.skill_name;
          }
        }
      });
    },
  confirmUpdate(){
    let updateSkill = {
      user_id : this.skillEdit.user_id,
      skill_name : this.newSkillName,
    }
    axios.put('/skills/' + this.skillEdit.id,updateSkill).then(()=>{
      this.newSkillName = '';
      this.getAllSkill();
      this.openBtn = "";
    })
  },


    
    changeFile(e) {
      this.imageFile = e.target.files[0];
      this.imageToDisplay = URL.createObjectURL(this.imageFile);
    },
    cancel(ifFalse) {
      this.showDialog = ifFalse;
      this.dialogSkill = ifFalse;
      this.newSkillName = "";
      this.openBtn = 'create';
    },
    getUserDetail() {
      axios.get("/user_details/" + this.user.id).then((res) => {
        this.userDetail = res.data[0];
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
        ];
      });
    },
    
    updateProfile() {
      this.dialog = false;
      let profile = new FormData();
      profile.append("picture", this.imageFile);
      profile.append("_method", "PUT");
      axios.post("/updateProfile/" + this.editProfileID, profile).then((res) => {
        this.name_img = res.data.img.picture;
        this.getAllData();
      });
    },
    getAllData() {
      this.user = JSON.parse(localStorage.getItem("user"));
      axios.get("/user_details/" + this.user.id).then((res) => {
        this.editProfileID = res.data[0].id;
        this.userDetail = res.data[0];
        this.first_name = this.user.first_name;
        this.last_name = this.user.last_name;
        this.phone = this.userDetail.phone;
        this.email = this.user.email;
        this.name_img = this.userDetail.picture;
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
        ];
      });
    },

  },
  mounted() {
    this.getAllSkill();
    this.getAllData();
    if (localStorage.getItem("id") != undefined) {
      axios.get("/user/" + localStorage.getItem("id")).then((res) => {
        this.user = res.data;
        localStorage.setItem("user", JSON.stringify(res.data));
        this.getUserDetail();
      });
    } else {
      this.user = JSON.parse(localStorage.getItem("user"));
      this.getUserDetail();
    }

  },
};
</script>
<style scoped>
.container,
.txt {
  display: flex;
}
.sub-txt {
  font-weight: bold;
  font-size: 2ch;
  width: 200px;
}
.txt span {
  margin: 5px;
}
.v-card{
  border: 3px solid #BDBDBD;
}
.dote{
  font-weight: bold;
  font-size: 2ch;
}
.v-icon.iconSkillEdit{
  /* font-size: 20px; */
  color: #66BB6A;
}
.v-icon.iconSkillDelete{
  font-size: 20px;
  color: red;
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
</style>
