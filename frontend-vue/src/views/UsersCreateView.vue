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
          User Registry
        </div>
        <div class="card-body">
          <form v-on:submit.prevent="save">
            <div class="d-grid col-6 mx-auto mb-3">
              <img height="100" class="img-thumbnail" id="photoimg" src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
              <input type="text" class="form-control" v-model="this.name" id="name" placeholder="Type your name" required maxlength="50">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
              <input type="text" class="form-control" v-model="idCardNumber" id="idCardNumber" placeholder="Type your id card number" required maxlength="10">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
              <input type="number" class="form-control" v-model="age" id="age" placeholder="Type your age" required maxlength="2">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa-solid fa-mars-and-venus"></i></span>
              <input type="number" class="form-control" v-model="genre" id="genre" placeholder="Type your genre" required maxlength="2">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
              <input type="email" class="form-control" v-model="email" id="email" placeholder="Type your email" required maxlength="50">
            </div>
            <div class="d-grid col-6 mx-auto mb-3">
              <button class="btn btn-success" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mostrarAlerta, enviarSolicitud } from '../functions'

  export default{

    data() {
      return{
         name:'',
         idCardNumber: '',
         age: null,
         genre: null,
         email: '',
         url: 'http://127.0.0.1:8000/api/users',
         isLoading: false,
      }
    },

    methods:{
      save(){
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
          enviarSolicitud('post', jsonData, this.url, 'User succesfully added!!')
        }
      },

    }
  }
</script>
