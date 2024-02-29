<template>
  <div class="d-grid col-6 mx-1 mb-3 mt-4">
    <router-link :to="{path:'/users'}" style="text-decoration: none; font-weight: bold;">
      <i class="fa-solid fa-arrow-left"></i>
      Go Back
    </router-link>
  </div>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header bg-dark text-white text-center">
          User Info
        </div>
        <div class="card-body">
          <div class="d-grid col-6 mx-auto mb-3">
            <img height="100" class="img-thumbnail" id="photoimg" src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <label v-text="this.name" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
            <label v-text="idCardNumber" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
            <label v-text="age" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-mars-and-venus"></i></span>
            <label v-text="genre" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
            <label v-text="email" class="form-control"></label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mostrarAlerta, enviarSolicitud } from '../functions'
  import {useRoute} from 'vue-router'
  import axios from 'axios'

  export default{

    data() {
      return{
        id: 0,
        name:'',
        idCardNumber: '',
        age: null,
        genre: null,
        email: '',
        user: null,
        url: 'http://127.0.0.1:8000/api/users',
        isLoading: false,
      }
    },

    mounted() {
      const route = useRoute()
      this.id = route.params.id
      this.url = `${this.url}/${this.id}`
      this.getUser()
    },

    methods:{

      getUser(){
        axios.get(this.url).then(
          res => {
            this.name = res.data.name
            this.idCardNumber = res.data.id_card_number
            this.age = res.data.age
            this.genre  = res.data.genre
            this.email  = res.data.email
            this.user = res.data
          }
        ) 
      },

      update(){
        if((this.name.trim() === '') ||
          (this.idCardNumber.trim() === '') ||
          (this.age < 18) ||
          (this.genre <= 0 || this.genre > 2) ||
          (this.email.trim() === '')
        ){
          mostrarAlerta('Type valid values into the fields', 'warning', 'name')
        } else{
          let jsonData = {
            name: this.name.trim(),
            id_card_number: this.idCardNumber.trim(),
            age: this.age,
            genre: this.genre,
            email: this.email.trim(),
          }
          enviarSolicitud('put', jsonData, this.url, 'User succesfully updated!!')
        }
      },

    }
  }
</script>
